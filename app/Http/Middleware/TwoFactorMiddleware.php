<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est authentifié et si le code 2FA est valide
        if ($user && (!$user->two_factor_code || $user->two_factor_expires_at <= now())) {
            return redirect()->route('verify.2fa')->with('error', 'Veuillez valider votre code 2FA.');
        }

        return $next($request);
    }
}
