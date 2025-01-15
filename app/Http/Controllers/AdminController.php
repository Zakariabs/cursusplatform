<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Alleen toegankelijk voor admins
    #[\Illuminate\Auth\Middleware\Authenticate]
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Toon lijst van alle gebruikers
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Toggle admin status
    public function toggleAdmin(User $user)
    {
        // Voorkom dat admin zichzelf aanpast
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Je kunt je eigen admin status niet aanpassen');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', 'Admin status aangepast');
    }

    // Toon formulier voor nieuwe gebruiker
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Sla nieuwe gebruiker op
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'is_admin' => 'boolean'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'is_admin' => $request->has('is_admin')
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Gebruiker aangemaakt');
    }
}