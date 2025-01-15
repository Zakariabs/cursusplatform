<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Toon contact formulier
    public function create()
    {
        return view('contact.create');
    }

    // Verwerk contact formulier
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        $validated['status'] = 'new';
        Contact::create($validated);

        return redirect()->back()
            ->with('success', 'Bericht succesvol verzonden');
    }

    // Admin: Bekijk alle berichten (alleen voor admins)
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('contact.index', compact('contacts'));
    }
}