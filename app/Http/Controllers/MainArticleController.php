<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class MainArticleController extends Controller
{
    public function __invoke()
    {
        $data = Article::paginate(3);
        $articles = $data->getCollection()->each(function ($article) {
            $article->excerpt = $article->getExcerpt();
            $article->readingTime = $article->getReadingTime();
        });

        return inertia('Article/Index', [
            'articles' => $articles,
            'paginationLinks' => $data
        ]);
    }
}
