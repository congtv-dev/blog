<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Frontend\ArticleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index() {
        $articles = $this->articleService->getArticlesByUserId(Auth::id());
        $fullname = Auth::user()->fullname;

        return view('frontend.article.index', compact('articles', 'fullname'));
    }
    
    public function publish($userId, $fullname) {
        $articles = $this->articleService->getPublishedArticlesByUserId($userId);
        
        return view('frontend.article.index', compact('articles', 'fullname'));
    }
    
    public function read($id) {
        $article = $this->articleService->getArticle($id);
        
        return view('frontend.article.read', compact('article'));
    }
    
    public function delete($id) {
        $deleted = $this->articleService->delete($id);
        
        if ($deleted > 0) {
            Session::flash('message', 'Delete an article successfully.');
        }

        return back();
    }
    
    public function create() {
        return view('frontend.article.create');
    }
    
    public function update($id) {
        $article = $this->articleService->getArticle($id);

        return view('frontend.article.update', compact('article'));
    }
    
    public function save(BlogRequest $request, $id = NULL) {
        if (isset($id)) {
            $article = $this->articleService->update($request, $id);
            $message = 'Update an article successfully.';
        } else {
            $article = $this->articleService->create($request);
            $message = 'Create an article successfully.';
        }


        if ($article) {
            Session::flash('message', $message);

            return redirect()->route('home');
        } else {
            return back();
        }
    }
}
