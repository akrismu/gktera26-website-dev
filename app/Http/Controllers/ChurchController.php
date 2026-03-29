<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Banner;
use Illuminate\Http\Request;

class ChurchController extends Controller
{
    public function index()
    {
        $banner = Banner::where('page_identifier', 'churches')
            ->where('is_active', true)
            ->first();
        
        // $churches = Church::where('is_active', true)
        //     ->with(['bannerMedia', 'contact'])
        //     ->get();
        
        // return view('churches.index', compact('banner', 'churches'));

        $churches = Church::with(['contact', 'previewMedia'])->get();

        $churchDataForMap = $churches->map(function($church) {
            return [
                'name' => $church->name,
                'slug' => $church->slug,
                'short_description' => $church->short_description,
                'village' => $church->village,
                'latitude' => $church->latitude,
                'longitude' => $church->longitude,
                'address' => $church->contact?->address ?? '',
                'phone' => $church->contact?->phone ?? '',
                'previewImage' => $church->previewMedia
                    ? asset('storage/' . $church->previewMedia->path)
                    : null,
            ];
        });

        return view('churches.index', [
            'churches' => $churches,
            'churchDataForMap' => $churchDataForMap,
            'banner' => $banner,
        ]);
    }
    
    public function show($slug)
    {
        $church = Church::where('slug', $slug)
            ->where('is_active', true)
            ->with(['bannerMedia', 'previewMedia', 'services', 'contact', 'images.media'])
            ->firstOrFail();

        // Latest news for the bottom section
        $latestNews = \App\Models\News::where('is_published', true)
            ->with(['previewMedia', 'featuredMedia'])
            ->latest('published_at')
            ->take(3)
            ->get();
        
        return view('churches.show', compact('church', 'latestNews'));
    }
}