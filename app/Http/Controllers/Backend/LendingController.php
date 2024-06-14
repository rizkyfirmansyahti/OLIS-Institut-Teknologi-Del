<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Lending;
use App\Models\CompactDisk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LogLending;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type = null)
    {
        $this->checkType($type);

        return view('backend.lendings.index', compact('type'));
    }

    public function list(Request $request, $type = null, $status = null)
    {
        $this->checkType($type);
        return view('backend.lendings.list', compact('type', 'status'));
    }

    public function data(Request $request, $type = null, $status = null)
    {
        $this->checkType($type);
        if ($request->ajax()) {
            if ($type == 'book') {
                $lendings = Lending::with('user', 'book')->whereNotNull('book_id')->latest();
            } else {
                $lendings = Lending::with('user', 'compactDisk')->whereNotNull('compact_disk_id')->latest();
            }
            if ($status) {
                if ($status == 'all') {
                    $lendings->where('status', 'returned')->orWhere('status', 'rejected');
                } else {
                    $lendings->where('status', $status);
                }
            }

            // $lendings = $lendings->get(); // Execute the query
            $data = DataTables::of($lendings)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !is_null($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->whereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        })->orWhereHas('book', function ($q) use ($search) {
                            $q->where('title', 'like', "%$search%");
                        })->orWhereHas('compactDisk', function ($q) use ($search) {
                            $q->where('title', 'like', "%$search%");
                        });
                    }
                })
                ->editColumn('id', function ($lending) {
                    return encodeId($lending->id);
                })
                ->addColumn('item', function ($lending) use ($type) {
                    return $type == 'book' ? $lending->book->title : $lending->compactDisk->title;
                });

            if ($request->limit) {
                $data->setTotalRecords($request->limit);
            }

            return $data->toJson();
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        $this->checkType($type);
        // if null, return 404
        if ($type != 'book' && $type != 'cd') {
            return back()->with('error', 'Invalid type');
        }
        if ($type == 'book') {
            $books = Book::groupBy('title')->where('status', '1')->get();
            $compactDisks = [];
        } else {
            $books = [];
            $compactDisks = CompactDisk::all();
        }
        $users = User::role(['lecturer', 'student', 'staff'])->get();
        return view('backend.lendings.create', compact('books', 'compactDisks', 'users', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $type)
    {
        try {
            $this->checkType($request->type);
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'book_slug' => 'required_without:compact_disk_id|exists:books,slug',
                'compact_disk_id' => 'required_without:book_slug|integer|exists:compact_disks,id',
                'return_date' => 'required|date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            if ($type == 'book') {
                $book = Book::where('slug', $request->book_slug)->where('status', '1')->first();
                if (!$book) {
                    return redirect()->back()->with('error', 'Book not found');
                }
            }
            DB::beginTransaction();
            $lending = Lending::create([
                'user_id' => $request->user_id,
                'book_id' => $book->id,
                'compact_disk_id' => $request->compact_disk_id,
                'lending_date' => Carbon::now(),
                'return_date' => $request->return_date,
                'status' => 'lent',
            ]);

            LogLending::create([
                'lending_id' => $lending->id,
                'status' => 'lent',
            ]);

            if ($type == 'book') {
                $book->status = 2;
                $book->save();
            } else {
                $compactDisk = CompactDisk::find($request->compact_disk_id);
                $compactDisk->status = 2;
                $compactDisk->save();
            }

            $user = User::find($request->user_id);
            $user->lending_count = $user->lending_count + 1;
            $user->save();

            DB::commit();
            return redirect()->route('backend.lendings.index', $request->type)->with('success', 'Lending created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create lending');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($type, $lending)
    {
        $this->checkType($type);
        $lending = Lending::find(decodeId($lending));
        return view('backend.lendings.show', compact('lending', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type, $lending,)
    {
        $lending = Lending::find(decodeId($lending));
        if (!$lending) {
            return redirect()->route('lendings.index')->with('error', 'Lending not found');
        }
        if ($type == 'book') {
            $books = Book::groupBy('title')->get();
            $compactDisks = [];
        } else {
            $books = [];
            $compactDisks = CompactDisk::all();
        }
        $users = User::role(['lecturer', 'student', 'staff'])->get();
        return view('backend.lendings.edit', compact('lending', 'books', 'compactDisks', 'users', 'type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $type, $lending)
    {
        try {
            $this->checkType($type);
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'book_slug' => 'required_without:compact_disk_id|exists:books,slug',
                'compact_disk_id' => 'required_without:book_slug|integer|exists:compact_disks,id',
                'return_date' => 'required|date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $book = Book::where('slug', $request->book_slug)->where('status', '1')->first();
            if (!$book) {
                return redirect()->back()->with('error', 'Book not found');
            }
            DB::beginTransaction();
            $lending = Lending::find(decodeId($lending));
            $lending->update([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'compact_disk_id' => $request->compact_disk_id,
                'return_date' => $request->return_date,
            ]);
            DB::commit();
            return redirect()->route('backend.lendings.index', $type)->with('success', 'Lending updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('backend.lendings.index', $type)->with('error', 'Failed to update lending');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($type, $lending)
    {
        try {
            $this->checkType($type);
            DB::beginTransaction();
            $lending = Lending::find(decodeId($lending));
            $lending->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Lending deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to delete lending']);
        }
    }

    public function history(Request $request)
    {
        if ($request->ajax()) {
            $lendings = Lending::with('user', 'book', 'compactDisk');
            return DataTables::of($lendings)
                ->editColumn('id', function ($lending) {
                    return encodeId($lending->id);
                })
                ->addColumn('item', function ($lending) {
                    return $lending->book ? $lending->book->title : $lending->compactDisk->title;
                })
                ->make(true);
        }
        return view('backend.lendings.history');
    }

    public function approve($type, $lending)
    {
        try {
            $this->checkType($type);
            DB::beginTransaction();
            $lending = Lending::find(decodeId($lending));
            $lending->update([
                'status' => 'lent'
            ]);

            $book = Book::find($lending->book_id);
            $book->status = 2;
            $book->save();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Lending approved successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to approve lending']);
        }
    }

    public function reject($type, $lending)
    {
        try {
            $this->checkType($type);
            DB::beginTransaction();
            $lending = Lending::find(decodeId($lending));
            $lending->update([
                'status' => 'rejected'
            ]);

            $user = User::find($lending->user_id);
            $user->lending_count = $user->lending_count - 1;
            $user->save();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Lending rejected successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to reject lending']);
        }
    }

    public function return($type, $lending)
    {
        try {
            $this->checkType($type);
            DB::beginTransaction();
            $lending = Lending::find(decodeId($lending));
            // calculate fine
            $this->calculateFine($lending);
            $lending->update([
                'status' => 'returned'
            ]);

            $book = Book::find($lending->book_id);
            $book->status = 1;
            $book->save();

            // update user lending count
            $user = User::find($lending->user_id);
            $user->lending_count = $user->lending_count - 1;
            $user->save();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Lending returned successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to return lending']);
        }
    }

    public function extend(Request $request, $type, $lending)
    {
        if ($request->isMethod('get')) {
            $this->checkType($type);
            $lending = Lending::find(decodeId($lending));
            return view('backend.lendings.extend', compact('lending', 'type'));
        } else {
            return $this->doExtend($request, $type, $lending);
        }
    }

    public function report()
    {
        return view('backend.lendings.report');
    }

    private function calculateFine($lending)
    {
        $returnDate = $lending->extend_date ? $lending->extend_date : $lending->return_date;
        $now = Carbon::now();
        $fine = 0;
        if ($now->gt($returnDate)) {
            $diff = $now->diffInDays($returnDate);
            $fine = $diff * 2000;
        }
        $lending->update([
            'fine' => $fine
        ]);
    }

    private function doExtend($request, $type, $lending)
    {
        try {
            $this->checkType($type);
            $validator = Validator::make($request->all(), [
                'extended_return_date' => 'required|date',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $lending = Lending::find(decodeId($lending));
            $lending->update([
                'extend_date' => $request->extended_return_date,
                'return_date' => $request->extended_return_date,
            ]);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Lending extended successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to extend lending']);
        }
    }

    private function checkType($type)
    {
        if ($type != 'book' && $type != 'cd') {
            return back()->with('error', 'Invalid type');
        }
    }
}
