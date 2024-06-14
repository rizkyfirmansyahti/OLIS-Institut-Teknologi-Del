<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $total = Book::groupBy('slug')->count();
        $books = Book::where('title', 'like', '%' . $search . '%')
            ->orWhere('author', 'like', '%' . $search . '%')
            ->orWhere('publisher', 'like', '%' . $search . '%')
            ->orWhere('year', 'like', '%' . $search . '%')
            ->groupBy('slug')
            ->paginate(6);

        $books->withPath(url()->current());

        $bestBooks = Book::has('reviews')
            ->groupBy('slug')
            ->withCount('reviews')
            ->get()
            ->sortByDesc('rating')
            ->take(4);

        // get last date updated book
        $lastUpdated = Book::latest()->first();

        // DD($books);
        // return view('frontend.books.index', compact('books', 'bestBooks', 'lastUpdated', 'total'));
        return view('frontend_revisi.books.index', compact('books', 'bestBooks', 'lastUpdated', 'total'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();
        if (!$book) {
            return redirect()->route('books.index')->with('error', 'Data tidak ditemukan');
        }

        $book = Book::where('slug', $slug)->where('status', '1')->first();
        if (!$book) {
            $book = Book::where('slug', $slug)->first();
        }
        // return view('frontend.books.show', compact('book'));
        return view('frontend_revisi.books.show', compact('book'));
    }

    /**
     * Review book
     */
    public function review(Request $request, $slug)
    {
        $book = Book::where('slug', $slug)->get();
        // find available book by status
        $book = $book->where('status', '1')->first();
        if (!$book) {
            $book = Book::where('slug', $slug)->first();
        }
        try {
            $validator = Validator::make($request->all(), [
                'rating' => 'required|numeric|min:1|max:5',
                'comment' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ]);
            }

            DB::beginTransaction();
            $book->reviews()->create([
                'user_id' => auth()->user()->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Review berhasil',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ]);
        }
    }
}
