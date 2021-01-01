@extends('profile.userMenu')
@section('things')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-6">Reakce na komentáře:</h1>
                <div class="likedComments">
                    @foreach($profile->user->commentRatings as $rating)
                        <a href="{{ route('showMovie', $rating->comment->movie->id) }}">{{ $rating->comment->movie->name }}</a> -
                        <a href="{{ route('showProfile', $rating->comment->user->id) }}">{{ $rating->comment->user->name }}</a> -
                        {{ \App\Models\Rating::where(['user_id' => $rating->comment->user_id, 'movie_id' => $rating->comment->movie->id])->first()->rate }} hvězd/y |
                        @if($rating->value == 1)
                            👍
                        @else
                            👎
                        @endif
                        <p>{{ $rating->comment->content }}</p>
                        <hr></hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
