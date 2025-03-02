<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\ArticleService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    
    public function index() {
        $featuredArticles = $this->articleService->getFeaturedArticles();
        $homeArticles = $this->articleService->getHomeArticles();
        $recentArticles = $this->articleService->getRecentArticles();

        return view('frontend.home.index', compact('featuredArticles', 'homeArticles', 'recentArticles'));
    }
}
