<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Faq;

class DashboardController extends Controller
{
    #[\Illuminate\Auth\Middleware\Authenticate]
    public function index()
    {
        $latestNews = News::latest('publish_date')->take(3)->get();
        $faqs = Faq::inRandomOrder()->take(3)->get();

        return view('dashboard', compact('latestNews', 'faqs'));
    }
}