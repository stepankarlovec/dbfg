@extends('layouts.app')

@section('content')

<div class="container">
    @auth
    <form method="post"  enctype="multipart/form-data" action="{{ route('addMovie') }}">
        @csrf
        <div class="col-md-6 my-1">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Movie name">

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 my-1">
            @include('layouts.countrylist')
        </div>
        <div class="col-md-6 my-1">
            <input id="genre" type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre') }}" required autocomplete="genre" autofocus placeholder="genre">

            @error('genre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 my-1">
            <input id="release_date" type="date" class="form-control @error('release_date') is-invalid @enderror" name="release_date" value="{{ old('release_date') }}" required autocomplete="release_date" autofocus placeholder="release date">

            @error('release_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 my-1">
            <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autocomplete="duration" autofocus placeholder="Duration (min)">

            @error('duration')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong> 
            </span>
            @enderror
        </div>
        <div class="col-md-6 my-1">
            <input id="director" type="text" class="form-control @error('director') is-invalid @enderror" name="director" value="{{ old('director') }}" required autocomplete="director" autofocus placeholder="Director">

            @error('director')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 my-1">
            <input id="actors" type="text" class="form-control @error('actors') is-invalid @enderror" name="actors" value="{{ old('actors') }}" required autocomplete="actors" autofocus placeholder="Main actors">

            @error('actors')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 my-1">
            <textarea id="about" class="form-control @error('about') is-invalid @enderror" name="about" value="{{ old('about') }}" required autocomplete="about" autofocus placeholder="About movie">
            </textarea>

            @error('about')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 my-1">
            <input id="image" type="file" class="file-form-control" name="image" value="{{ old('image') }}" autocomplete="image" autofocus placeholder="Main image">

            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6 my-2">
        <input type="submit" class="btn btn-success">
        </div>
    </form>
    @endauth
    @guest
    <p>You need to <a href="{{ route('login') }}">log-in</a></p>
    @endguest
</div>

@endsection