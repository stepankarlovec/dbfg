@extends('profile.userMenu')
@section('things')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hodnocení:</h1>
                <div class="ratedMovies">
                    @foreach($profile->user->ratings as $rating)
                        <a href="{{ route('showMovie', $rating->movie->id)  }}">{{ $rating->movie->name }}</a> - {{ $rating->rate }} hvězd/y
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
