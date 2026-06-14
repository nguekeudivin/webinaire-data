<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('admin.change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = Admin::find(session('admin_id'));

        if (!$admin || !password_verify($request->input('current_password'), $admin->password_hash)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $admin->update([
            'password_hash' => password_hash($request->input('password'), PASSWORD_DEFAULT),
        ]);

        return back()->with('status', 'Votre mot de passe a été mis à jour.');
    }
}
