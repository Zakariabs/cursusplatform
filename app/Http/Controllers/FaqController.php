<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Toon alle FAQs gegroepeerd per categorie
    public function index()
    {
        $categories = FaqCategory::with('faqs')->get();
        return view('faq.index', compact('categories'));
    }

    // Formulier voor nieuwe FAQ
    public function create()
    {
        $categories = FaqCategory::all();
        return view('faq.create', compact('categories'));
    }

    // Opslaan van nieuwe FAQ
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'faq_category_id' => 'required|exists:faq_categories,id'
        ]);

        Faq::create($validated);

        return redirect()->route('faq.index')
            ->with('success', 'FAQ succesvol toegevoegd');
    }

    // Toon één FAQ
    public function show(Faq $faq)
    {
        return view('faq.show', compact('faq'));
    }

    // Formulier om FAQ te bewerken
    public function edit(Faq $faq)
    {
        $categories = FaqCategory::all();
        return view('faq.edit', compact('faq', 'categories'));
    }

    // Update een FAQ
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'faq_category_id' => 'required|exists:faq_categories,id'
        ]);

        $faq->update($validated);

        return redirect()->route('faq.index')
            ->with('success', 'FAQ succesvol bijgewerkt');
    }

    // Verwijder een FAQ
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faq.index')
            ->with('success', 'FAQ succesvol verwijderd');
    }
}