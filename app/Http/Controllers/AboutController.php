<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Employee;
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
        
        $chairman = $employees->where('is_chairman', true)->first();
        $boardMembers = $employees->where('is_chairman', false);
        
        return view('about.sinode', compact('banner', 'chairman', 'boardMembers'));
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
        
        $employees = Employee::where('department', 'ministry')
            ->with('photoMedia')
            ->orderBy('order')
            ->get();
        
        return view('about.ministry', compact('banner', 'employees'));
    }
}