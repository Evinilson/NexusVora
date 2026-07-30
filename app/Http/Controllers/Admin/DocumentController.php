<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ProjectDocumentMail;
use App\Models\DocumentLog;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
    private const VALID_TYPES = ['inicio_projeto', 'lista_tarefas', 'relatorio_estado'];

    private const TYPE_VIEWS = [
        'inicio_projeto'   => 'documents.inicio-projeto',
        'lista_tarefas'    => 'documents.lista-tarefas',
        'relatorio_estado' => 'documents.relatorio-estado',
    ];

    public function preview(Project $project, string $type)
    {
        abort_unless(in_array($type, self::VALID_TYPES), 404);

        $project->load(['client', 'tasks', 'documentLogs']);

        $pdf = Pdf::loadView(self::TYPE_VIEWS[$type], compact('project'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream($type . '.pdf');
    }

    public function send(Request $request, Project $project)
    {
        $data = $request->validate([
            'type'  => ['required', Rule::in(self::VALID_TYPES)],
            'email' => ['required', 'email'],
        ]);

        $project->load(['client', 'tasks', 'documentLogs']);

        $pdf = Pdf::loadView(self::TYPE_VIEWS[$data['type']], compact('project'))
            ->setPaper('a4', 'portrait');

        $tmpPath = tempnam(sys_get_temp_dir(), 'nexusvora_doc_') . '.pdf';
        $pdf->save($tmpPath);

        try {
            Mail::to($data['email'])->send(
                new ProjectDocumentMail($project, $data['type'], $tmpPath)
            );

            DocumentLog::create([
                'project_id'    => $project->id,
                'client_id'     => $project->client_id,
                'type'          => $data['type'],
                'sent_to_email' => $data['email'],
                'sent_at'       => now(),
            ]);
        } finally {
            @unlink($tmpPath);
        }

        return back()->with('success', 'Documento enviado com sucesso para ' . $data['email']);
    }

    public function download(Project $project, string $type)
    {
        abort_unless(in_array($type, self::VALID_TYPES), 404);

        $project->load(['client', 'tasks', 'documentLogs']);

        $filename = match ($type) {
            'inicio_projeto'   => 'ficha-inicio-projeto',
            'lista_tarefas'    => 'lista-tarefas',
            'relatorio_estado' => 'relatorio-estado',
        };

        $pdf = Pdf::loadView(self::TYPE_VIEWS[$type], compact('project'))
            ->setPaper('a4', 'portrait');

        return $pdf->download($filename . '-' . now()->format('Y-m-d') . '.pdf');
    }
}
