<?php

namespace App\Http\Middleware\Frontend;

use App\Models\Article;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $articleId = $request->route('id');

        if (!Article::where('id', $articleId)->where('user_id', Auth::id())->exists()) {
            Session::flash('message', 'You have no permission to do the action.');
            
            return redirect()->route('home');
        }

        return $next($request);
    }
}
