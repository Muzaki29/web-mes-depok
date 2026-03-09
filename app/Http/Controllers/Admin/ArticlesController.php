<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('admin.articles.index');
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);
        $data['slug'] = Str::slug($data['title']).'-'.Str::random(6);
        $data['author_id'] = auth()->id();
        Article::create($data);
        return redirect()->route('admin.articles.index')->with('status','Article created');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);
        $article->update($data);
        return redirect()->route('admin.articles.index')->with('status','Article updated');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return back()->with('status','Article deleted');
    }
}

