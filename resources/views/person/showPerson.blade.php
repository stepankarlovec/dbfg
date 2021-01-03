@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @auth
            @if($person->verified == 0)
                <a class="text-secondary" href="{{ route('editPerson', $person->id) }}">Upravit</a>
            @endif
            @endauth
            <div class="d-flex">
                <h1 class="display-4">{{ $person->name }}</h1>
                <img class="ml-5" src="../{{ $person->image }}" width="25%">
            </div>

            <div class="d-flex">
                <p class="">{{ date("d.m.Y", strtotime($person->birth)) }}</p>
                <p class="pl-2">{{ $person->birth_place }}</p>
            </div>
            <p>@empty($person->bio) Nic tu není.. :( @endempty {{ $person->bio }}</p>
        </div>
        <div class="col-md-6">
            <h1 class="mt-3 display-6">Obsazení:</h1>
            <ul class="list-group">
            @foreach($movies as $movie)
                    <li class="list-group-item text-center"><b><a href="/movie/{{ $movie->id }}">{{ $movie->name }}</a></b></li>
            @endforeach
            </ul>

        </div>
        <div class="d-flex col-md-2">
            <a href="/person/{{ $person->id +1}}">Další</a>
            <a class="ml-2" href="/person/{{ $person->id -1}}">Předchozí</a>
        </div>
    </div>
</div>
@endsection
