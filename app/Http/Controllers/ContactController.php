<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'sector' => 'nullable|string|max:255',
            'services' => 'nullable|string',
            'plan' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'message' => 'required|string',
            'privacy' => 'accepted',
        ]);

        $planContext = '';
        if ($request->plan || $request->category) {
            $planContext = "Plano selecionado: " . ($request->plan ?? 'Não indicado') . "\n"
                . "Categoria: " . ($request->category ?? 'Não indicada') . "\n\n";
        }

        Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'service_interest' => $request->services,
            'message' => $planContext . "Sector: " . ($request->sector ?? 'Não indicado') . "\n\nMensagem:\n" . $request->message,
            'status' => 'novo',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'company', 'sector', 'services', 'plan', 'category', 'message']);

        try {
            Mail::to('geral@nexusvora.com')->send(new ContactFormMail($data));
        } catch (\Exception $e) {
            // Lead is already saved; email delivery can be retried operationally if needed.
        }

        return response()->json(['success' => true]);
    }
}
