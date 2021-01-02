@extends('profile.userMenu')
@section('things')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-6">Oblíbené filmy:</h1>
                <div class="likedComments">
                    @foreach($profile->user->favoriteMovies as $favMovie)
                        <a href="{{ route('showMovie', $favMovie->movie->id) }}">{{ $favMovie->movie->name }}</a>
                        <hr></hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
