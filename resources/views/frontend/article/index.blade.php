@extends('frontend.layouts.app')

@section('title', 'Articles List')

@section('content')
@php
$defaultThumbnail = asset("storage/images/default-thumbnail.jpg");
@endphp

    <div class="row">
        <div class="col-12">
            <h3 class="page-title">{{ $fullname }}'s Articles</h3>
        </div>
    </div>

    <div class="row mb-2">
        @foreach($articles as $article)
        @php
        $slug = Str::slug($article->title);
        @endphp

        <div class="col-md-6 article">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <h3 class="mb-0">{{ $article->title }}</h3>
              <div class="mb-1 text-body-secondary">{{ $article->created_at->format('Y/m/d') }}</div>
              <p class="card-text mb-auto">{{ $article->description }}</p>
              <a href='{{ url("article/{$article->id}/{$slug}") }}' class="icon-link gap-1 icon-link-hover">
                Continue reading
                <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
              </a>
              
              @if($article->user_id == auth()->id())
              <a href='{{ url("article/{$article->id}/update") }}'>Update</a>
              <a href="{{ url("article/{$article->id}/delete") }}">Delete</a>
              @endif
            </div>
            <div class="col-auto d-none d-lg-block"> 
              <img src="{{ empty($article->thumbnail) ? $defaultThumbnail : asset("storage/{$article->thumbnail}") }}" alt="{{ $article->title }}">
            </div>
          </div>
        </div>
        @endforeach
    </div>
@endsection