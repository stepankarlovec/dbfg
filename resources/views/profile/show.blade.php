@extends('profile.userMenu')
@section('things')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>{{ $profile->bio }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <hr></hr>
                {{ $profile->user->points }} bodů
                <ul class="list-inline">
                    <li class="list-inline-item">{{ $profile->user->comments->count() }} komentář/ů</li>
                    <li class="list-inline-item">{{ $profile->user->ratings->count() }} hodnocení</li>
                    <li class="list-inline-item">{{ $profile->user->commentRatings->count() }} reakcí</li>
                </ul>
            </div>
        </div>

    </div>
@endsection
