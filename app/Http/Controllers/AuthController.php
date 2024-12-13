<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Vérifier si le code 2FA doit être généré
            if (!$user->two_factor_code || $user->two_factor_expires_at <= now()) {
                $user->generateTwoFactorCode();

                // Ajouter un message flash uniquement si le code est généré
                if (!session()->has('2fa_message_sent')) {
                    session()->flash('success', 'Un code de double authentification a été envoyé à votre adresse e-mail.');
                    session()->put('2fa_message_sent', true);
                }
            }

            return redirect()->route('verify.2fa');
        }

        return back()->withErrors(['email' => 'Identifiants invalides.']);
    }



    public function showTwoFactorForm()
    {
        return view('auth.two_factor');
    }

    public function verifyTwoFactor(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);

        $user = Auth::user();

        if ($user->two_factor_code === $request->code && $user->two_factor_expires_at > now()) {
            // Réinitialiser le code 2FA
            $user->resetTwoFactorCode();

            // Supprimer le flag de session
            session()->forget('2fa_message_sent');

            return redirect()->route('posts.index'); // Exemple de redirection
        }

        return back()->withErrors(['code' => 'Code invalide ou expiré.']);
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
