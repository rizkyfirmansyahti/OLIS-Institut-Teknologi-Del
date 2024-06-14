<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::find(auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('backend.profile.index')->with('success', 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(auth()->id());
        if (!password_verify($request->current_password, $user->password)) {
            return redirect()->route('backend.profile.index')->with('error', 'Current password is incorrect');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('backend.profile.index')->with('success', 'Password changed successfully');
    }
}
