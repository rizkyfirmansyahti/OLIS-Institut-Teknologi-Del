<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LogLending;
use Illuminate\Support\Facades\Validator;

class LendingController extends Controller
{
    public function index()
    {
        $lendings = Lending::where('user_id', auth()->user()->id)
            ->orderBy('lending_date', 'desc')
            ->paginate(5);
        // return view('frontend.lendings.index', compact('lendings'));
        return view('frontend_revisi.lendings.index', compact('lendings'));
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'book_id' => 'required',
                'return_date' => 'required|date|after:today',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ]);
            }

            if ($this->checkLendingLimit()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda telah mencapai batas peminjaman',
                ]);
            }

            $book = Book::find(decodeId($request->book_id));

            if ($book->status == 2) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Buku sedang dipinjam',
                ]);
            }

            $lending = Lending::create([
                'book_id' => $book->id,
                'user_id' => auth()->user()->id,
                'lending_date' => Carbon::now(),
                'return_date' => $request->return_date,
            ]);

            $book->status = 2;
            $book->save();

            LogLending::create([
                'lending_id' => $lending->id,
                'status' => 'pending',
            ]);

            $user = User::find(auth()->user()->id);
            $user->lending_count = $user->lending_count + 1;
            $user->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Peminjaman berhasil',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Peminjaman gagal',
            ]);
        }
    }

    private function checkLendingLimit()
    {
        return auth()->user()->lending_count >= auth()->user()->lending_limit;
    }
}
