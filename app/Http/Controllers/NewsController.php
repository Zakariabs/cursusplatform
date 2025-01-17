<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class NewsController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $newsItems = News::latest()->paginate(12);
        return view('news.index', compact('newsItems'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function create()
    {
        if(!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Toegang geweigerd');
        }
        return view('news.create');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Toegang geweigerd');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Nieuws artikel succesvol aangemaakt.');
    }

    public function edit(News $news)
    {
        if(!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Toegang geweigerd');
        }
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        if(!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Toegang geweigerd');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Nieuws artikel succesvol bijgewerkt.');
    }

    public function destroy(News $news)
    {
        if(!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Toegang geweigerd');
        }
        
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Nieuws artikel succesvol verwijderd.');
    }
}