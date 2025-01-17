<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        return view('faq.index', compact('faqs'));
    }

    public function show(Faq $faq)
    {
        return view('faq.show', compact('faq'));
    }

    public function create()
    {
        $this->authorize('admin');
        return view('faq.create');
    }

    public function store(Request $request)
    {
        $this->authorize('admin');
        
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string',
        ]);

        Faq::create($validated);

        return redirect()->route('faq.index')->with('success', 'FAQ succesvol aangemaakt.');
    }

    public function edit(Faq $faq)
    {
        $this->authorize('admin');
        return view('faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $this->authorize('admin');
        
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string',
        ]);

        $faq->update($validated);

        return redirect()->route('faq.index')->with('success', 'FAQ succesvol bijgewerkt.');
    }

    public function destroy(Faq $faq)
    {
        $this->authorize('admin');
        $faq->delete();
        return redirect()->route('faq.index')->with('success', 'FAQ succesvol verwijderd.');
    }
}