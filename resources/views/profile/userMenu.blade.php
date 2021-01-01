@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex">
                    <a class="text-dark text-decoration-none" href="{{ route('showProfile', $profile->id) }}"><h1 class="display-5">{{ $profile->user->name }}</h1></a>
                </div>
                <div class="d-inline-flex">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="{{ route('showProfile', $profile->id) }}">O mně</a></li>
                        <li class="list-inline-item"><a href="{{ route('showRated', $profile->id) }}">Hodnocené filmy</a></li>
                        <li class="list-inline-item"><a href="{{ route('showComments', $profile->id) }}">Komentáře</a></li>
                        <li class="list-inline-item"><a href="{{ route('showReactions', $profile->id) }}">Reakce</a></li>
                        <li class="list-inline-item"><a href="#">Oblíbené filmy</a></li>
                        @if($profile->id == auth()->user()->id)
                            | <li class="list-inline-item"><a class="text-secondary" href="{{ route('editProfile', $profile) }}">Upravit</a></li>
                        @endif
                    </ul>
                </div>
            </div>
    @yield('things')
        </div>
    </div>
@endsection
