<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $articles = Article::where('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%')
            ->paginate(6);
        $articles->withPath(url()->current());
        $lastUpdated = Article::latest()->first();

        // dd($articles);
        // return view('frontend.articles.index', compact('articles', 'lastUpdated'));
        return view('frontend_revisi.articles.index', compact('articles', 'lastUpdated'));
    }

    public function show($article)
    {
        $article = Article::where('slug', $article)->first();
        if (!$article) {
            return redirect()->route('articles.index')->with('error', 'Data tidak ditemukan');
        }

        $article->increment('views');

        // dd($article);
        // return view('frontend.articles.show', compact('article'));
        return view('frontend_revisi.articles.show', compact('article'));
    }
}
