<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // book with highest rating

        $bestBooks = Book::has('reviews')
            ->groupBy('slug')
            ->withCount('reviews')
            ->get()
            ->sortByDesc('rating')
            ->take(4);
        // dd($bestBooks);
        // return view('frontend.home.index', compact('bestBooks'));
        return view('frontend_revisi.home.index', compact('bestBooks'));
        // return view('layouts.frontend_revisi.master', compact('bestBooks'));
    }
}
