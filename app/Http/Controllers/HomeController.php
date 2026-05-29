<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $menus = Menu::where('is_active', true)->orderBy('order')->get();
        $projects = Project::where('is_published', true)->orderBy('order')->get();
        $skills = Skill::orderBy('order')->get();

        return view('index', compact('settings', 'menus', 'projects', 'skills'));
    }
}
