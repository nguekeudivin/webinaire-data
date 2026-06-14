<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::all();
        return view('admin.admins', ['admins' => $admins]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);

        User::create([
            'name' => $request->input('email'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return redirect()->route('admin.admins')->with('status', 'Administrateur créé.');
    }

    public function destroy(Request $request)
    {
        $id = (int) $request->input('delete_id', 0);

        if ($id === Auth::id()) {
            return redirect()->route('admin.admins')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        if ($id > 0) {
            User::destroy($id);
        }

        return redirect()->route('admin.admins')->with('status', 'Administrateur supprimé.');
    }
}
