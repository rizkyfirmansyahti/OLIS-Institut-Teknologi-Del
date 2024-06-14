<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\Article;
use App\Models\CompactDisk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function articles(Request $request)
    {
        // get latest articles in this week
        $articles = Article::latest()->where('created_at', '>=', now()->subDays(7))->paginate(6);
        $articles->withPath(url()->current());
        // ambil tanggal perubahan terakhir
        $lastUpdated = Article::latest()->first();
        // return view('frontend.notifications.articles', compact('articles', 'lastUpdated'));
        return view('frontend_revisi.notifications.articles', compact('articles', 'lastUpdated'));
    }

    public function books(Request $request)
    {
        // get latest books
        $books = Book::groupBy('slug')->latest()->where('created_at', '>=', now()->subDays(7))->paginate(6);
        $books->withPath(url()->current());
        $lastUpdated = Book::latest()->first();
        // return view('frontend.notifications.books', compact('books', 'lastUpdated'));
        // dd($books);
        return view('frontend_revisi.notifications.books', compact('books', 'lastUpdated'));
    }

    public function compactDisks(Request $request)
    {
        // get latest compact disks
        $compactDisks = CompactDisk::latest()->where('created_at', '>=', now()->subDays(7))->paginate(6);
        $compactDisks->withPath(url()->current());
        $lastUpdated = CompactDisk::latest()->first();
        return view('frontend_revisi.notifications.compact-disks', compact('compactDisks', 'lastUpdated'));
        // return view('frontend.notifications.compact-disks', compact('compactDisks', 'lastUpdated'));
    }
}
