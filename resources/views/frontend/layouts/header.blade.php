<div class="container">
  <header class="border-bottom lh-1">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand logo" href="{{ route('home') }}">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <div class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              @if(auth()->check())
              @php
                $fullname = auth()->user()->fullname;
              @endphp
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ url("articles/{$fullname}") }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ $fullname }}
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href='{{ url("articles/{$fullname}") }}'>My Articles</a></li>
                  <li><a class="dropdown-item" href="{{ route('article.create') }}">Create an Article</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                </ul>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('user.login') }}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('user.register') }}">Register</a>
              </li>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>

  @if(session()->has('message'))
  <p class="alert alert-info">{{ session()->get('message') }}</p>
  @endif
</div>