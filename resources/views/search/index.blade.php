@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-4">
        <h1 class="display-6">Filmy:</h1>
        <ul class="list-group">
            @foreach($movies as $movie)
                <li class="list-group-item text-center"><b><a href="/movie/{{ $movie->id }}">{{ $movie->name }}</a></b> ({{ $year = date('Y', strtotime($movie->release_date)) }})</li>
            @endforeach
        </ul>
        {{ $movies->links("pagination::bootstrap-4") }}
    </div>
    <div class="col-md-4">
        <h1 class="display-6">Osoby:</h1>
        <ul class="list-group">
            @foreach($persons as $person)
                <li class="list-group-item text-center"><b><a href="/person/{{ $person->id }}">{{ $person->name }}</a></b></li>
            @endforeach
        </ul>
        {{ $movies->links("pagination::bootstrap-4") }}
    </div>

    <div class="col-md-4">
        <h1 class="display-6">Uživatelé:</h1>
        <ul class="list-group">
            @foreach($users as $user)
                <li class="list-group-item text-center"><b><a href="/profile/{{ $user->id }}">{{ $user->name }}</a></li>
            @endforeach
        </ul>
        {{ $movies->links("pagination::bootstrap-4") }}
    </div>
</div>
</div>
@endsection
