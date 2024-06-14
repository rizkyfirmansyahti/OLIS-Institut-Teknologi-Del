<?php

namespace App\Http\Controllers\Frontend;

use App\Models\CompactDisk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompactDiskController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $compactDisks = CompactDisk::where('title', 'like', '%' . $search . '%')
            ->orWhere('author', 'like', '%' . $search . '%')
            ->paginate(8);
        $compactDisks->withPath(url()->current());
        $lastUpdated = CompactDisk::latest()->first();
        // return view('frontend.compact-disks.index', compact('compactDisks', 'lastUpdated'));
        return view('frontend_revisi.compact-disks.index', compact('compactDisks', 'lastUpdated'));
    }

    public function show($compactDisk)
    {
        $compactDisk = CompactDisk::find(decodeId($compactDisk));
        // dd($compactDisk);
        return view('frontend_revisi.compact-disks.show', compact('compactDisk'));
        // return view('frontend.compact-disks.show', compact('compactDisk'));
    }
}
