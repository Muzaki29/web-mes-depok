<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->where('status','published')->firstOrFail();
        $more = Article::where('status','published')->where('id','<>',$article->id)->orderByDesc('published_at')->limit(4)->get();
        return view('public.article', compact('article','more'));
    }
}

