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

        $churches = Church::with('contact')->get();

        $churchDataForMap = $churches->map(function($church) {
            return [
                'name' => $church->name,
                'slug' => $church->slug,
                'latitude' => $church->latitude,
                'longitude' => $church->longitude,
                'address' => $church->contact?->address ?? '',
                'phone' => $church->contact?->phone ?? '',
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
            ->with(['bannerMedia', 'services', 'contact', 'images. media'])
            ->firstOrFail();
        
        return view('churches.show', compact('church'));
    }
}