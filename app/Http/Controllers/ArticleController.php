<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequests\StoreArticleRequest;
use App\Http\Requests\ArticleRequests\UpdateArticleRequest;
use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\LikeArticle;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{

    public function index()
    {
        $data = Article::paginate(2);
        $articles = $data->getCollection()->each(function ($article) {
            $article->excerpt = $article->getExcerpt();
            $article->readingTime = $article->getReadingTime();
        });

        return inertia('Admin/Article/Index', [
            'articles' => $articles,
            'paginationLinks' => $data
        ]);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        $likeArticle = LikeArticle::where('user_id', auth()->id())->get('article_id')->pluck('article_id')->toArray();

        if(in_array($article->id, $likeArticle)) {
            $article->is_liked = true;
        }
        $article->likes_count = LikeArticle::where('article_id', $article->id)->count();

        return inertia('Article/Show', [
            'article' => $article,
        ]);
    }

    public function create()
    {
        return inertia('Admin/Article/Create');
    }

    public function store(StoreArticleRequest $request)
    {
        $this->createOrUpdate(new Article, $request->prepareData());
        return redirect()->route('admin.panel');

    }

    public function edit(Article $article)
    {
        return inertia('Admin/Article/Edit', [
            'article' => $article
        ]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validate = $request->prepareData();
        if ($request->file('image')) {
            $path = Storage::disk('public')->put('images', $validate['image']);
            $fullPath = Storage::disk('public')->url($path);
            $validate['image'] = $fullPath;
        }
        $article->update($validate);

        return redirect()->route('admin.panel');
    }

    private function createOrUpdate(Article $article, $data)
    {
        $article->fill($data);
        $path = Storage::disk('public')->put('images', $article['image']);
        $fullPath = Storage::disk('public')->url($path);
        $article['image'] = $fullPath;
        $article->save();

        return $article;
    }

    public function destroy(Article $article)
    {
        $article->delete();
    }

    public function comment(Article $article, CommentRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $data['article_id'] = $article->id;
        $data['user_id'] = auth()->id();
        $comment = Comment::create($data);
        $comment->user = $user;
        return $comment;
    }

    public function commentList(Article $article)
    {
        $comments = $article->comments()->with('user')->latest()->get()->map(function ($comment) {
            $comment->formatted_created_at = $comment->created_at->diffForHumans();
            $comment->makeHidden(['created_at']);
            return $comment;
        });
        return $comments;
    }


    public function toggleLike(Article $article)
    {
        $res = auth()->user()->likeArticles()->toggle($article->id);

        $data['is_liked'] = count($res['attached']) > 0;
        $data['likes_count'] = $article->likeUsers()->count();
        return $data;
    }
}
