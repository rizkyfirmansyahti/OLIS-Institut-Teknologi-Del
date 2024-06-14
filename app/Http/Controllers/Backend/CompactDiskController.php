<?php

namespace App\Http\Controllers\Backend;

use App\Traits\Upload;
use App\Models\CompactDisk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\CompactDisksExport;
use App\Http\Controllers\Controller;
use App\Imports\CompactDisksImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CompactDiskController extends Controller
{
    use Upload;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $compactDisks = CompactDisk::latest();
            return DataTables::of($compactDisks)
                ->editColumn('id', function ($compactDisk) {
                    return encodeId($compactDisk->id);
                })
                ->toJson();
        }
        return view('backend.compact-disks.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.compact-disks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|unique:compact_disks,code',
                'title' => 'required|string',
                'subject' => 'required|string',
                'author' => 'required|string',
                'description' => 'required|string',
                'source' => 'required|string',
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'major' => 'required|string',
                'cd_dvd' => 'required|string',
                'year' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $cover = $this->uploadFile($request->file('cover'), 'CompactDisks');
            $lastId = CompactDisk::latest()->first()->id ?? 0;
            $data = $request->except('_token', 'cover');
            $data['cover'] = $cover;
            $data['code'] = generateCode($lastId);

            CompactDisk::create($data);

            DB::commit();

            return redirect()->route('backend.compact-disks.index')->with('success', 'Compact Disk created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('backend.compact-disks.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $compactDisk)
    {
        $compactDisk = CompactDisk::find(decodeId($compactDisk));
        if (!$compactDisk) {
            return redirect()->route('backend.compact-disks.index')->with('error', 'Compact Disk not found');
        }
        return view('backend.compact-disks.show', compact('compactDisk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($compact_disk)
    {
        $compact_disk = CompactDisk::find(decodeId($compact_disk));
        return view('backend.compact-disks.edit', compact('compact_disk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $compact_disk)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|unique:compact_disks,code,' . $compact_disk,
                'title' => 'required|string',
                'subject' => 'required|string',
                'author' => 'required|string',
                'description' => 'required|string',
                'source' => 'required|string',
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'major' => 'required|string',
                'cd_dvd' => 'required|string',
                'year' => 'required|integer',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $compact_disk = CompactDisk::find(decodeId($compact_disk));

            $data = $request->except('_token', 'cover');
            if ($request->hasFile('cover')) {
                // if has cover, delete the cover
                if ($compact_disk->cover) {
                    $this->deleteFile($compact_disk->cover);
                }
                $data['cover'] = $this->uploadFile($request->file('cover'), 'CompactDisks');
            }

            $compact_disk->update($data);

            DB::commit();

            return redirect()->route('backend.compact-disks.index')->with('success', 'Compact Disk updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('backend.compact-disks.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($compact_disk)
    {
        try {
            $compact_disk = CompactDisk::find(decodeId($compact_disk));
            if (!$compact_disk) {
                return response()->json(['status' => 'error', 'message' => 'Compact Disk not found']);
            }
            // if has cover, delete the cover
            if ($compact_disk->cover) {
                $this->deleteFile($compact_disk->cover);
            }
            DB::beginTransaction();
            $compact_disk->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Compact Disk deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to delete Compact Disk']);
        }
    }

    /**
     * Import data
     *
     */
    public function import(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|mimes:csv,xlsx,xls',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first('file'));
            }

            $file = $request->file('file');
            DB::beginTransaction();
            Excel::import(new CompactDisksImport, $file);
            DB::commit();
            return redirect()->route('backend.compact-disks.index')->with('success', 'Data imported successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('backend.compact-disks.index')->with('error', 'Data import failed');
        }
    }

    /**
     * Export data
     *
     */
    public function export(Request $request)
    {
        $columns = $request->input('columns', []);
        if (empty($columns)) {
            return redirect()->back()->with('error', 'Please select at least one column to export.');
        }
        return Excel::download(new CompactDisksExport($columns), 'compact_disks.xlsx');
    }
}
