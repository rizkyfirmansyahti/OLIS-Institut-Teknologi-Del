<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->paginate(5);
        $announcements->withPath(url()->current());
        // return view('frontend.announcements.index', compact('announcements'));
        // dd($announcements);
        return view('frontend_revisi.announcements.index', compact('announcements'));
    }

    public function show($slug)
    {
        $announcement = Announcement::where('slug', $slug)->firstOrFail();
        // return view('frontend.announcements.show', compact('announcement'));
        // dd($announcement);
        return view('frontend_revisi.announcements.show', compact('announcement'));
    }
}
