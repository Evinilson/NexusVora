<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectDocumentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Project $project,
        public readonly string $documentType,
        public readonly string $pdfPath,
    ) {}

    public function envelope(): Envelope
    {
        $subject = match ($this->documentType) {
            'inicio_projeto'   => 'Ficha de Início de Projeto — ' . $this->project->title,
            'lista_tarefas'    => 'Lista de Tarefas — ' . $this->project->title,
            'relatorio_estado' => 'Relatório de Estado — ' . $this->project->title,
            default            => 'Documento — ' . $this->project->title,
        };

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.project-document');
    }

    public function attachments(): array
    {
        $filename = match ($this->documentType) {
            'inicio_projeto'   => 'ficha-inicio-projeto',
            'lista_tarefas'    => 'lista-tarefas',
            'relatorio_estado' => 'relatorio-estado',
            default            => 'documento',
        };

        return [
            Attachment::fromPath($this->pdfPath)
                ->as($filename . '-' . now()->format('Y-m-d') . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
