<?php

namespace App\Http\Controllers\Backend;

use DOMDocument;
use App\Traits\Upload;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ArticleExport;
use App\Imports\ArticlesImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    use Upload;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $articles = Article::latest();
            return DataTables::of($articles)
                ->editColumn('id', function ($article) {
                    return encodeId($article->id);
                })
                ->toJson();
        }
        return view('backend.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $image = $this->uploadFile($request->file('image'), 'articles');
            DB::beginTransaction();
            $excerpt = \Soundasleep\Html2Text::convert($request->body);
            $excerpt = preg_replace('/\s+/', ' ', $excerpt);
            $excerpt = Str::words($excerpt, 100, '');
            Article::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'body' => $request->body,
                'excerpt' => $excerpt,
                'image' => $image,
            ]);
            DB::commit();
            return redirect()->route('backend.articles.index')->with('success', 'Article created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('backend.articles.index')->with('error', 'Failed to create article');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($article)
    {
        $article = Article::find(decodeId($article));
        if (!$article) {
            return redirect()->route('backend.articles.index')->with('error', 'Article not found');
        }
        return view('backend.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($article)
    {
        $article = Article::find(decodeId($article));
        if (!$article) {
            return redirect()->route('backend.articles.index')->with('error', 'Article not found');
        }
        return view('backend.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $article)
    {
        try {
            $article = Article::find(decodeId($article));
            if (!$article) {
                return redirect()->route('backend.articles.index')->with('error', 'Article not found');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $excerpt = \Soundasleep\Html2Text::convert($request->body);
            $excerpt = preg_replace('/\s+/', ' ', $excerpt);
            $excerpt = Str::words($excerpt, 100, '');
            $article->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'body' => $request->body,
                'excerpt' => $excerpt,
            ]);

            if ($request->hasFile('image')) {
                $image = $this->uploadFile($request->file('image'), 'articles');
                $article->update(['image' => $image]);
            }

            DB::commit();
            return redirect()->route('backend.articles.index')->with('success', 'Article updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('backend.articles.index')->with('error', 'Failed to update article');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($article)
    {
        try {
            $article = Article::find(decodeId($article));
            if (!$article) {
                return response()->json(['status' => 'error', 'message' => 'Article not found']);
            }
            DB::beginTransaction();
            $article->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Article deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to delete article']);
        }
    }

    /**
     * Import data
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

            DB::beginTransaction();
            $file = $request->file('file');
            Excel::import(new ArticlesImport, $file);
            DB::commit();
            return redirect()->route('backend.articles.index')->with('success', 'Data imported successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to import data');
        }
    }

    /**
     * Export data
     */
    public function export(Request $request)
    {
        return Excel::download(new ArticleExport, 'articles.xlsx');
    }
}
