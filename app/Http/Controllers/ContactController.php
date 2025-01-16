<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
   // Formulier tonen
   #[\Illuminate\Routing\Middleware\SubstituteBindings]
   public function create()
   {
       return view('contact.create');
   }

   // Bericht opslaan 
   #[\Illuminate\Routing\Middleware\SubstituteBindings]
   public function store(Request $request)
   {
       $validated = $request->validate([
           'name' => 'required|max:255',
           'email' => 'required|email',
           'subject' => 'required|max:255',
           'message' => 'required'
       ]);

       // Maak contact bericht aan
       $contact = Contact::create([
           'name' => $validated['name'],
           'email' => $validated['email'], 
           'subject' => $validated['subject'],
           'message' => $validated['message'],
           'status' => 'new'
       ]);

       try {
           // Stuur email (gaat naar logs in lokale omgeving)
           Mail::to('admin@ehb.be')->send(new ContactFormMail($contact));
       } catch (\Exception $e) {
           // Log de error maar laat gebruiker doorgaan
           \Log::error('Email kon niet worden verstuurd: '.$e->getMessage());
       }

       return redirect()->back()
           ->with('success', 'Bericht succesvol verzonden! We nemen spoedig contact met u op.');
   }

   // Admin overzicht van berichten
   #[\Illuminate\Auth\Middleware\Authenticate]
   #[\App\Http\Middleware\AdminMiddleware]  
   public function index()
   {
       $messages = Contact::latest()->get();
       return view('contact.index', compact('messages'));
   }
}