<?php

namespace App\Services\Frontend;

use App\Enums\Status;
use App\Http\Requests\Frontend\BlogRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleService {
    public function create(BlogRequest $request) {
        $data = $request->safe()->only(['title', 'description', 'content']);

        $article = new Article;
        $article->user_id = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnail = $file->store('articles', 'public');

            $article->thumbnail = $thumbnail;
        }

        $article->title = $data['title'];
        $article->description = $data['description'];
        $article->content = $data['content'];

        return $article->save();
    }

    public function delete($id) {
        return Article::find($id)->delete();
    }

    public function update(BlogRequest $request, $id) {
        $data = $request->safe()->only(['title', 'description', 'content']);

        $article = $this->getArticle($id);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnail = $file->store('articles', 'public');

            $article->thumbnail = $thumbnail;
        }

        $article->title = $data['title'];
        $article->description = $data['description'];
        $article->content = $data['content'];

        return $article->save();
    }

    public function getFeaturedArticles() {
        return Article::select('id', 'title', 'description', 'thumbnail', 'content', 'user_id', 'created_at')
        ->where('featured', Status::Yes)
        ->where('approved', Status::Yes)
        ->where('published', Status::Yes)
        ->orderBy('id', 'desc')
        ->limit(10)
        ->get();
    }
    
    public function getHomeArticles() {
        return Article::select('id', 'title', 'description', 'thumbnail', 'content', 'user_id', 'created_at')
        ->where('on_home', Status::Yes)
        ->where('approved', Status::Yes)
        ->where('published', Status::Yes)
        ->orderBy('id', 'desc')
        ->paginate(20);
    }

    public function getRecentArticles() {
        return Article::select('id', 'title', 'description', 'thumbnail', 'content', 'user_id', 'created_at')
        ->where('approved', Status::Yes)
        ->where('published', Status::Yes)
        ->orderBy('id', 'desc')
        ->limit(10)
        ->get();
    }
    
    public function getPublishedArticlesByUserId($userId) {
        return Article::select('id', 'title', 'description', 'thumbnail', 'content', 'user_id', 'created_at')
        ->where('user_id', $userId)
        ->where('approved', Status::Yes)
        ->where('published', Status::Yes)
        ->orderBy('id', 'desc')
        ->paginate(20);
    }
    
    public function getArticlesByUserId($userId) {
        return Article::select('id', 'title', 'description', 'thumbnail', 'content', 'user_id', 'created_at')
        ->where('user_id', $userId)
        ->orderBy('id', 'desc')
        ->paginate(20);
    }
    
    public function getArticle($id) {
        return Article::select('id', 'title', 'description', 'thumbnail', 'content', 'user_id', 'created_at')
        ->where('approved', Status::Yes)
        ->where('published', Status::Yes)
        ->find($id);
    }
}