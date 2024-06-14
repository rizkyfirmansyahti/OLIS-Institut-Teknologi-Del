<?php

namespace App\Http\Controllers\Frontend;

use App\Models\SiteLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteLinkController extends Controller
{
    public function index()
    {
        $siteLinks = SiteLink::all();
        // return view('frontend.site-links.index', compact('siteLinks'));
        return view('frontend_revisi.site-links.index', compact('siteLinks'));
    }
}
