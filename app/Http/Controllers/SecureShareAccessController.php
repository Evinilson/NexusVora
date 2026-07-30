<?php

namespace App\Http\Controllers;

use App\Models\SecureShare;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class SecureShareAccessController extends Controller
{
    public function show(string $token): View|Response
    {
        $share = SecureShare::where('token', $token)->first();

        if (! $share) {
            return response()->view('secure-shares.invalid', status: 404);
        }

        return view('secure-shares.access', [
            'share' => $share,
            'unlocked' => false,
        ]);
    }

    public function unlock(Request $request, string $token): View|Response
    {
        $share = SecureShare::where('token', $token)->first();

        if (! $share) {
            return response()->view('secure-shares.invalid', status: 404);
        }

        $data = $request->validate([
            'access_code' => ['required', 'string', 'max:40'],
        ]);

        if ($share->isExpired()) {
            return view('secure-shares.access', [
                'share' => $share,
                'unlocked' => false,
            ])->withErrors(['access_code' => 'Esta partilha ja expirou.']);
        }

        if (! $share->checkAccessCode($data['access_code'])) {
            return back()->withErrors(['access_code' => 'Codigo de acesso invalido.']);
        }

        $share->recordAccess();

        return view('secure-shares.access', [
            'share' => $share->fresh(),
            'unlocked' => true,
        ]);
    }
}
