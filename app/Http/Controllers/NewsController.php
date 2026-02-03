<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Banner;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $banner = Banner::where('page_identifier', 'news')
            ->where('is_active', true)
            ->first();
        
        $news = News::where('is_published', true)
            ->with('featuredMedia')
            ->latest('published_at')
            ->paginate(9);
        
        return view('news.index', compact('banner', 'news'));
    }
    
    public function show($slug)
    {
        $article = News::where('slug', $slug)
            ->where('is_published', true)
            ->with('featuredMedia')
            ->firstOrFail();
        
        $relatedNews = News::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->limit(3)
            ->get();
        
        return view('news.show', compact('article', 'relatedNews'));
    }
}