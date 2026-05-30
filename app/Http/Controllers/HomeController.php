<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\FocusArea;
use App\Models\AboutStat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $menus = Menu::where('is_active', true)->orderBy('order')->get();
        $projects = Project::where('is_published', true)->orderBy('order')->get();
        $skills = Skill::orderBy('order')->get();
        $focusAreas = FocusArea::where('is_published', true)->orderBy('order')->get();
        $aboutStats = AboutStat::where('is_published', true)->orderBy('order')->get();

        // Log page visit
        \App\Models\Analytics::create([
            'key' => 'page_visit',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return view('index', compact('settings', 'menus', 'projects', 'skills', 'focusAreas', 'aboutStats'));
    }

    public function downloadCv()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $cvPath = $settings['developer_cv'] ?? null;

        if ($cvPath && \Illuminate\Support\Facades\Storage::disk('public')->exists($cvPath)) {
            // Log CV download
            \App\Models\Analytics::create([
                'key' => 'cv_download',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            return \Illuminate\Support\Facades\Storage::disk('public')->download($cvPath);
        }

        abort(404, 'CV file not found.');
    }
}
