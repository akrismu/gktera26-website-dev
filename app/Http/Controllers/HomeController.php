<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Church;
use App\Models\News;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('page_identifier', 'home')
            ->where('is_active', true)
            ->get();

        $imgUrl = Banner::where('page_identifier', 'history')
            ->where('is_active', true)
            ->get();
        
        $churches = Church::where('is_active', true)
            ->limit(6)
            ->get();
        
        $latestNews = News::where('is_published', true)
            ->latest('published_at')
            ->limit(3)
            ->get();

        $latestNewsletters = Newsletter::where('is_active', true)
            ->orderByDesc('year')
            ->orderBy('order')
            ->limit(3)
            ->get();
        
        return view('home', compact('banners', 'imgUrl', 'churches', 'latestNews', 'latestNewsletters'));
    }

    public function index1()
    {
        return view('home');
    }
}