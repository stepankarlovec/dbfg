@extends('profile.userMenu')
@section('things')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Komentáře:</h1>
                <div class="comments">
                    @foreach($profile->user->comments as $comment)
                        <a href="{{ route('showMovie', $comment->movie->id) }}">{{ $comment->movie->name }}</a> -
                        <a href="{{ route('showProfile', $comment->user->id) }}">{{ $comment->user->name }}</a> -
                        {{ $comment->user->ratings->where('movie_id', $comment->movie->id)->first()->rate }} hvězd/y
                        <p>{{ $comment->content }}</p>
                        <hr></hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
