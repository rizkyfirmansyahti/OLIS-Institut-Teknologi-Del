<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // $announcements = Announcement::latest()->limit(5)->get();
        return view('frontend.dashboard.index');
    }
}
