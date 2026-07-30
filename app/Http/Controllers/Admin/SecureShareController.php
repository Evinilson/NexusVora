<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SecureShare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecureShareController extends Controller
{
    public function index()
    {
        $shares = SecureShare::latest()->get();

        return view('admin.secure-shares.index', compact('shares'));
    }

    public function create()
    {
        return view('admin.secure-shares.form', [
            'share' => new SecureShare([
                'expires_at' => now()->addDay(),
            ]),
            'generatedAccessCode' => $this->makeAccessCode(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'recipient_name' => ['nullable', 'string', 'max:255'],
            'recipient_email' => ['nullable', 'email', 'max:255'],
            'secure_url' => ['nullable', 'url', 'max:2000'],
            'secret_payload' => ['nullable', 'string', 'max:20000'],
            'access_code' => ['nullable', 'string', 'min:4', 'max:40'],
            'expires_at' => ['required', 'date', 'after:now'],
        ]);

        if (blank($data['secure_url'] ?? null) && blank($data['secret_payload'] ?? null)) {
            return back()
                ->withInput()
                ->withErrors(['secret_payload' => 'Adiciona um link ou dados sensiveis para partilhar.']);
        }

        SecureShare::create([
            'title' => $data['title'],
            'recipient_name' => $data['recipient_name'] ?? null,
            'recipient_email' => $data['recipient_email'] ?? null,
            'token' => SecureShare::makeToken(),
            'access_code_hash' => Hash::make($data['access_code'] ?: $this->makeAccessCode()),
            'secure_url' => $data['secure_url'] ?? null,
            'secret_payload' => $data['secret_payload'] ?? null,
            'expires_at' => $data['expires_at'],
        ]);

        return redirect()->route('admin.secure-shares.index')->with('success', 'Partilha segura criada.');
    }

    public function destroy(SecureShare $secureShare)
    {
        $secureShare->delete();

        return redirect()->route('admin.secure-shares.index')->with('success', 'Partilha segura eliminada.');
    }

    private function makeAccessCode(): string
    {
        return sprintf('%03d-%03d', random_int(100, 999), random_int(100, 999));
    }
}
