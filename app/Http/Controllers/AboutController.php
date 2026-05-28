<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Employee;
use App\Models\Ministry;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $banner = Banner::where('page_identifier', 'about')
            ->where('is_active', true)
            ->first();
        
        return view('about.index', compact('banner'));
    }
    
    public function sinode()
    {
        $banner = Banner:: where('page_identifier', 'sinode')
            ->where('is_active', true)
            ->first();
        
        $employees = Employee::where('department', 'sinode')
            ->with('photoMedia')
            ->orderBy('order')
            ->get();
        
        $chairmen = $employees->where('is_chairman', true)->values();
        $boardMembers = $employees->where('is_chairman', false)->values();
        
        return view('about.index', compact('banner', 'chairmen', 'boardMembers'));
    }
    
    public function history()
    {
        $banner = Banner::where('page_identifier', 'history')
            ->where('is_active', true)
            ->first();
        
        return view('about.history', compact('banner'));
    }
    
    public function mission()
    {
        $banner = Banner::where('page_identifier', 'mission')
            ->where('is_active', true)
            ->first();
        
        return view('about.mission', compact('banner'));
    }
    
    public function ministry()
    {
        $banner = Banner::where('page_identifier', 'ministry')
            ->where('is_active', true)
            ->first();

        $ministries = Ministry::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        return view('about.ministry', compact('banner', 'ministries'));
    }

    public function ministryShow($slug)
    {
        $ministry = Ministry::where('slug', $slug)
            ->where('is_active', true)
            ->with(['bannerMedia', 'images.media'])
            ->firstOrFail();

        return view('about.ministry-detail', compact('ministry'));
    }

    public function newsletters()
    {
        $banner = Banner::where('page_identifier', 'about')
            ->where('is_active', true)
            ->first();

        $newsletters = Newsletter::where('is_active', true)
            ->orderByDesc('year')
            ->orderBy('order')
            ->get();

        $newslettersByYear = $newsletters->groupBy('year')->sortKeysDesc();

        return view('about.newsletters', compact('banner', 'newsletters', 'newslettersByYear'));
    }

    public function newsletterDownload(Newsletter $newsletter)
    {
        $filePath = storage_path('app/public/' . $newsletter->file_path);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, $newsletter->file_name);
    }
}