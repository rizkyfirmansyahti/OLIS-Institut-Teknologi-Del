<?php

namespace App\Http\Controllers\Backend;

use App\Traits\Upload;
use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    use Upload;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $announcements = Announcement::latest();
            return DataTables::of($announcements)
                ->editColumn('id', function ($announcement) {
                    return encodeId($announcement->id);
                })
                ->toJson();
        }

        return view('backend.announcements.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|in:pin,unpin'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $image = $this->uploadFile($request->file('image'), 'announcements');
            DB::beginTransaction();
            Announcement::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $image,
                'status' => $request->status,
            ]);
            DB::commit();
            return redirect()->route('backend.announcements.index')->with('success', 'Announcement created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('backend.announcements.index')->with('error', 'Failed to create announcement');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($announcement)
    {
        $announcement = Announcement::find(decodeId($announcement));
        if (!$announcement) {
            return redirect()->route('backend.announcements.index')->with('error', 'Announcement not found');
        }
        return view('backend.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($announcement)
    {
        $announcement = Announcement::find(decodeId($announcement));
        if (!$announcement) {
            return redirect()->route('backend.announcements.index')->with('error', 'Announcement not found');
        }
        return view('backend.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $announcement)
    {
        try {
            $announcement = Announcement::find(decodeId($announcement));
            if (!$announcement) {
                return back()->with('error', 'Announcement not found');
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|in:pin,unpin'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $image = $announcement->image;
            if ($request->hasFile('image')) {
                $image = $this->uploadImage($request->file('image'), 'announcements');
            }

            DB::beginTransaction();
            $announcement->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $image,
                'status' => $request->status,
            ]);
            DB::commit();
            return redirect()->route('backend.announcements.index')->with('success', 'Announcement updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update announcement');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($announcement)
    {
        try {
            $announcement = Announcement::find(decodeId($announcement));
            if (!$announcement) {
                return response()->json(['status' => 'error', 'message' => 'Announcement not found']);
            }
            // if has image, delete the image
            if ($announcement->image) {
                $this->deleteFile($announcement->image);
            }
            DB::beginTransaction();
            $announcement->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Announcement deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to delete announcement']);
        }
    }

    /**
     * Change status announcement
     */
    public function changeStatus($announcement)
    {
        try {
            $announcement = Announcement::find(decodeId($announcement));
            if (!$announcement) {
                return response()->json(['status' => 'error', 'message' => 'Announcement not found']);
            }
            $status = $announcement->status == 'pin' ? 'unpin' : 'pin';
            $announcement->update(['status' => $status]);
            return response()->json(['status' => 'success', 'message' => 'Announcement status changed successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to change announcement status']);
        }
    }
}
