@extends('frontend.layouts.app')

@section('title', $article->title)

@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="article-title">{{ $article->title }}</h3>
            <div class="mb-3 text-body-secondary">{{ $article->created_at->format('Y/m/d') }}</div>

            {{ $article->content }}
        </div>
    </div>
@endsection