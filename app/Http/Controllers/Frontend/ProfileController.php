<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // return view('frontend.profile.index');
        return view('frontend_revisi.profile.index');
    }

    public function edit()
    {
        return view('frontend.profile.edit');
    }

    public function update()
    {
        return redirect()->route('profile.index')->with('success', 'Profile updated');
    }

    public function changePassword()
    {
        return view('frontend.profile.change-password');
    }

    public function updatePassword()
    {
        return redirect()->route('profile.index')->with('success', 'Password updated');
    }
}
