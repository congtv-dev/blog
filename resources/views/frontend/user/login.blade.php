@extends('frontend.layouts.app')

@section('title', 'Login')

@section('content')
    
<div class="row d-flex flex-row justify-content-center">
    <div class="col-6">
        <h3 class="page-title">Login Account</h2>
            
        @if ($errors->any())
        <div class="alert alert-warning" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('user.signin') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control @error('email')error @enderror" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password')error @enderror" id="password" name="password">
            </div>
            
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
  
@endsection