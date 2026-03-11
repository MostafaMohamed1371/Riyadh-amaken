<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Slider;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'sliders' => Slider::count(),
            'categories' => Category::count(),
            'gallery' => Gallery::count(),
            'activities' => Activity::count(),
            'events' => Event::count(),
            'users' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
