@extends('frontend.layouts.app')

@section('title', 'Update An Article')

@section('content')

    <div class="row d-flex flex-row justify-content-center">
        <div class="col-6">
            <h3 class="page-title">Update An Article</h3>

            @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ url()->current() }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title')error @enderror" id="title" name="title" value="{{ old('title', $article->title) }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description')error @enderror" id="description" name="description">{{ old('description', $article->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                </div>
                <div class="mb-3">
                    @if(!empty($article->thumbnail))
                    <a href="{{ asset('storage/' . $article->thumbnail) }}" target="_blank">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Thumbnail" class="thumbnail">
                    </a>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content')error @enderror" id="content" name="content">{{ old('content', $article->content) }}</textarea>
                </div>
                
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection