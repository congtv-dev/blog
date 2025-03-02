@extends('frontend.layouts.app')

@section('title', 'Technology Blog')

@section('content')
  @php
    $defaultThumbnail = asset("storage/images/default-thumbnail.jpg");
  @endphp

    <div class="p-2 p-md-2 mb-4 rounded text-body-emphasis bg-body-secondary">
      <div class="col-lg-6 px-0">
        <img src="{{ asset('storage/images/banner.jpg') }}" alt="Banner" class="banner">
      </div>
    </div>
  
    <div class="row mb-2">
      @foreach($featuredArticles as $article)
      @php
      $slug = Str::slug($article->title);
      @endphp

      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0">{{ $article->title }}</h3>
            <div class="mb-1 text-body-secondary">{{ $article->created_at->format('Y/m/d') }}</div>
            <p class="card-text mb-auto">{{ $article->description }}</p>
            <a href='{{ url("article/{$article->id}/{$slug}") }}' class="icon-link gap-1 icon-link-hover stretched-link">
              Continue reading
              <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
            </a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="{{ empty($article->thumbnail) ? $defaultThumbnail : asset("storage/{$article->thumbnail}") }}" alt="{{ $article->title }}">
          </div>
        </div>
      </div>
      @endforeach
    </div>
  
    <div class="row g-5">
      <div class="col-md-8">
  
        @foreach($homeArticles as $article)
        @php
        $slug = Str::slug($article->title);
        @endphp
        <article class="blog-post">
          <h3 class="link-body-emphasis mb-1">
            <a href='{{ url("article/{$article->id}/{$slug}") }}'>
            {{ $article->title }}
            </a>
          </h3>
          <p class="blog-post-meta">{{ $article->created_at->format('Y/m/d') }} by <a href='{{ url("articles/{$article->user_id}/{$article->user->fullname}") }}'>{{ $article->user->fullname }}</a></p>
          {{ $article->description }}
        </article>
        @endforeach

        <!--
        <nav class="blog-pagination" aria-label="Pagination">
          <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
          <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
        </nav>
      -->
      </div>
  
      <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
          <div class="p-4 mb-3 bg-body-tertiary rounded">
            <h4 class="fst-italic">About</h4>
            <p class="mb-0">
              This is a sample introduction about this blog.
            </p>
          </div>
  
          <div>
            <h4 class="fst-italic">Recent posts</h4>
            <ul class="list-unstyled recent-list">
              @foreach($recentArticles as $article)
              @php
              $slug = Str::slug($article->title);
              @endphp
              <li>
                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href='{{ url("article/{$article->id}/{$slug}") }}'>
                  <img src="{{ empty($article->thumbnail) ? $defaultThumbnail : asset("storage/{$article->thumbnail}") }}" alt="{{ $article->title }}">
                  <div class="col-lg-8">
                    <h6 class="mb-0">{{ $article->title }}</h6>
                    <small class="text-body-secondary">{{ $article->created_at->format('Y/m/d') }}</small>
                  </div>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
          
        </div>
      </div>
    </div>
  
@endsection