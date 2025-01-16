<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    // Verwijder de __construct methode en gebruik attributes

    #[\Illuminate\Routing\Middleware\SubstituteBindings]
    public function index()
    {
        $news = News::orderBy('publish_date', 'desc')->get();
        return view('news.index', compact('news'));
    }

    #[\Illuminate\Auth\Middleware\Authenticate]
    #[\App\Http\Middleware\AdminMiddleware]
    public function create()
    {
        return view('news.create');
    }

    #[\Illuminate\Auth\Middleware\Authenticate]
    #[\App\Http\Middleware\AdminMiddleware]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'publish_date' => 'required|date',
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('news', 'public');

        News::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'publish_date' => $validated['publish_date'],
            'image' => $path,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('news.index')
            ->with('success', 'Nieuws item succesvol toegevoegd');
    }

    #[\Illuminate\Routing\Middleware\SubstituteBindings]
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    #[\Illuminate\Auth\Middleware\Authenticate]
    #[\App\Http\Middleware\AdminMiddleware]
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    #[\Illuminate\Auth\Middleware\Authenticate]
    #[\App\Http\Middleware\AdminMiddleware]
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'publish_date' => 'required|date',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $path = $request->file('image')->store('news', 'public');
            $news->image = $path;
        }

        $news->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'publish_date' => $validated['publish_date']
        ]);

        return redirect()->route('news.show', $news)
            ->with('success', 'Nieuws item succesvol bijgewerkt');
    }

    #[\Illuminate\Auth\Middleware\Authenticate]
    #[\App\Http\Middleware\AdminMiddleware]
    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Nieuws item succesvol verwijderd');
    }
}