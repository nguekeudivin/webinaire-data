<?php

namespace App\Http\Controllers;

use App\Mail\AdminResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $error = '';

        $ipKey = 'login:' . $request->ip();
        if (RateLimiter::tooManyAttempts($ipKey, 5)) {
            $error = 'Trop de tentatives. Veuillez patienter 1 minute.';
        } else {
            RateLimiter::hit($ipKey, 60);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            $error = 'Identifiants incorrects.';
        }

        return view('admin.login', ['error' => $error]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function showForgotForm()
    {
        return view('admin.forgot_password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return back()->with('status', 'Si un compte existe avec cet email, un lien de réinitialisation a été envoyé.');
        }

        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->input('email')],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::to($request->input('email'))->queue(new AdminResetPasswordMail($token, $request->input('email')));

        return back()->with('status', 'Si un compte existe avec cet email, un lien de réinitialisation a été envoyé.');
    }

    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        $reset = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$reset || now()->diffInMinutes($reset->created_at) > 60) {
            return redirect()->route('admin.login')->with('error', 'Lien invalide ou expiré.');
        }

        return view('admin.reset_password', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->input('email'))
            ->where('token', $request->input('token'))
            ->first();

        if (!$reset || now()->diffInMinutes($reset->created_at) > 60) {
            return redirect()->route('admin.login')->with('error', 'Lien invalide ou expiré.');
        }

        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $user->password = $request->input('password');
            $user->save();
            DB::table('password_reset_tokens')->where('email', $request->input('email'))->delete();
        }

        return redirect()->route('admin.login')->with('status', 'Votre mot de passe a été réinitialisé.');
    }
}
