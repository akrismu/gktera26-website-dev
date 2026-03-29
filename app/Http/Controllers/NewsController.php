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
        
        $paginator = News::where('is_published', true)
            ->with(['featuredMedia', 'previewMedia'])
            ->latest('published_at')
            ->paginate(9);

        $newsArticles = collect($paginator->items())->map(function($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'excerpt' => $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->content), 120),
                'author' => $item->author ?? 'Admin', 
                'date' => $item->published_at,
                'previewImage' => [
                    'url' => $item->previewMedia
                        ? asset('storage/' . $item->previewMedia->path)
                        : ($item->featuredMedia
                            ? asset('storage/' . $item->featuredMedia->path)
                            : asset('images/default-news.jpg'))
                ]
            ];
        });
        
        return view('news.index', compact('banner', 'newsArticles', 'paginator'));
    }
    
    public function show($slug)
    {
        $news = News::where('slug', $slug)
            ->where('is_published', true)
            ->with(['featuredMedia', 'bannerMedia', 'previewMedia', 'images.media'])
            ->firstOrFail();

        return view('news.show', compact('news'));
    }
}