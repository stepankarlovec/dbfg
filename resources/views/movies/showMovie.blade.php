@extends('layouts.app')

@section('content')
<link href="{{ asset('css/movieView.css') }}" rel="stylesheet" >
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 class="display-4">{{ $movie->name }}</h1>
            <div class="d-flex">
                <p class="">{{ $movie->genre }}</p>
                <p class="pl-2">{{ $year = date('Y', strtotime($movie->release_date)) }}</p>
                <p class="pl-2">{{ $movie->duration }} minut</p>
            </div>
            <p>Režisér:
                @foreach ($personsDir as $personDir)
                <a href="/person/{{ $personDir->id }}">{{$personDir->name}}</a>,
                @endforeach
            </p>
            <p>Hlavní představitelé:
                @foreach ($persons as $person)
                <a href="/person/{{ $person->id }}">{{$person->name}}</a>,
                @endforeach
            </p>
            <p>
                {!!  substr(strip_tags($movie->about), 0, 150) !!}
                @if (strlen($movie->about) > 100)
                    <span id="dots">...</span>
                    <span id="more">{{ substr($movie->about, 100) }}</span>
                @endif
                <a href="#showMore" onclick="myFunction()" id="read">Zobrazit více</a>
            </p>

            <div class="row">
                <div class="col-md-6">
                    <p>Hodnocení:</p>
                    <span>&star;</span>
                    <span>&star;</span>
                    <span>&star;</span>
                    <span>&star;</span>
                    <span>&star;</span>
                </div>
                <div class="col-md-6">
                    <h1>95%</h1>
                    <p>156 hodnocení</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="/storage/{{ $movie->image }}">
        </div>
        <div class="d-flex col-md-2">
            @if($maxMovieId==$movie->id)
            @else
            <a href="/movie/{{ $movie->id +1}}">Další</a>
            @endif
            @if($minMovieId==$movie->id)
            @else
            <a class="ml-2" href="/movie/{{ $movie->id -1}}">Předchozí</a>
            @endif
        </div>
    </div>
</div>
<script src="{{ asset('js/movieView.js') }}"></script>
@endsection
