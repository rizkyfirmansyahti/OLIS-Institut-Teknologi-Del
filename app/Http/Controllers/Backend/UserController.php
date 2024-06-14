<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::latest()->get();
            return DataTables::of($users)
                ->editColumn('id', function ($user) {
                    return encodeId($user->id);
                })
                ->editColumn('roles', function ($user) {
                    return $user->getRoleNames()->first();
                })
                ->toJson();
        }
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_member' => 'required|unique:users,id_member',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'phone' => 'nullable|numeric',
                'address' => 'nullable',
                'major' => 'nullable',
                'position' => 'nullable',
                'status' => 'required|in:active,inactive',
                'role' => 'required|exists:roles,name',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $user = User::create($request->except('role', 'password') + [
                'password' => bcrypt($request->password),
            ]);

            if ($request->role == 'lecturer') {
                $user->lending_limit = 12;
            } elseif ($request->role == 'staff') {
                $user->lending_limit = 8;
            } elseif ($request->role == 'student') {
                $user->lending_limit = 4;
            }
            $user->save();

            $user->assignRole($request->role);

            DB::commit();

            return redirect()->route('backend.users.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create user');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = User::find(decodeId($user));
        if (!$user) {
            return redirect()->route('backend.users.index')->with('error', 'User not found');
        }
        return view('backend.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user)
    {
        $user = User::find(decodeId($user));
        if (!$user) {
            return redirect()->route('backend.users.index')->with('error', 'User not found');
        }
        $roles = Role::all();
        return view('backend.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user)
    {
        $user = User::find(decodeId($user));
        if (!$user) {
            return redirect()->route('backend.users.index')->with('error', 'User not found');
        }
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|numeric',
                'address' => 'nullable',
                'major' => 'nullable',
                'position' => 'nullable',
                'status' => 'required|in:active,inactive',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $user->update($request->except('role', 'password'));

            if ($request->password) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            if ($request->role == 'lecturer') {
                $user->lending_limit = 12;
            } elseif ($request->role == 'staff') {
                $user->lending_limit = 8;
            } elseif ($request->role == 'student') {
                $user->lending_limit = 4;
            }

            $user->save();

            $user->syncRoles($request->role);

            DB::commit();

            return redirect()->route('backend.users.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update user');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        try {
            $user = User::find(decodeId($user));
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'User not found']);
            }
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to delete user']);
        }
    }
}
