<?php

namespace App\Http\Controllers;

use App\Traits\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    use Upload;

    public function index()
    {
        // return view('auth.login');
        return view('auth_revisi.login');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'id_member' => 'required|exists:users,id_member',
                'password' => 'required'
            ], []);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $credentials = $request->only('id_member', 'password');

            if (Auth::attempt($credentials, $request->has('remember'))) {
                if (auth()->user()->hasRole('admin')) {
                    return redirect()->intended('/backend/dashboard');
                }
                return redirect()->intended('/');
            } else {
                return redirect()->back()->with('error', 'Invalid username or password.');
            }
        }
    }

    public function logout()
    {
        // clear session instance
        session()->forget('instance_id');
        auth()->logout();

        return redirect('/');
    }

    public function uploadImage()
    {
        try {
            if (request()->hasFile('image')) {
                $imageUrl = $this->uploadFile("image", 'gambarPage');
                if ($imageUrl) {
                    return response()->json(['status' => 1, 'path' => $imageUrl], 200);
                } else {
                    return response()->json(['status' => 0, 'errors' => 'Failed to upload image.'], 400);
                }
            } else {
                return response()->json(['status' => 0, 'errors' => 'Image not found.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'errors' => 'Unexpected error!'], 400);
        }
    }

    public function deleteImage()
    {
        try {
            $path = request()->path;
            $path = str_replace(asset('/'), '', $path);
            if (file_exists($path)) {
                unlink($path);
                return response()->json(['status' => 1, 'message' => 'Image deleted successfully.'], 200);
            } else {
                return response()->json(['status' => 0, 'errors' => 'Image not found.'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'errors' => 'Unexpected error!'], 400);
        }
    }

    public function username()
    {
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'username';
        request()->merge([$field => request()->email]);
        return $field;
    }
}
