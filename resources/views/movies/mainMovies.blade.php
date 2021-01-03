@extends('layouts.app')

@section('content')
<div>
    <div class="jumbotron">
        <div class="container">
        <h1 class="display-3">Jaký film si vyberete dnes?</h1>
        <p class="font-size-gay">Na naší stránce DBFG si určitě vyberete..</p>
        </div>
    </div>
    <div class="container">
        <h1 class="display-4 text-center">Náš výběr:</h1>
    <div class="row">
        @foreach($selectedMovies as $selectedMovie)
            <div class="col-md-3 selectedMovies p-3 text-center">
                <img class="img-responsive" src="/storage/{{ $selectedMovie->movie->image }}" width="200">
                <h1 class="display-6 pt-3"><a href="/movie/{{ $selectedMovie->movie->id }}">{{ $selectedMovie->movie->name }}</a></h1>
                <p>{{ $year = date('Y', strtotime($selectedMovie->movie->release_date)) }} | {{ round($selectedMovie->movie->movieRating->average * 20) }}%</p>
            </div>
        @endforeach
    </div>
    <hr />
    </div>
    <div class="container">
        <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item-swag text-center"><h1 class="display-6 text-black text-center ">Nejnovější přidané:</h1></li>
            @foreach($movies as $movie)
                <li class="list-group-item text-center"><b><a href="/movie/{{ $movie->id }}">{{ $movie->name }}</a></b> ({{ $year = date('Y', strtotime($movie->release_date)) }}) - {{ round($movie->movieRating->average * 20) }}%</li>
            @endforeach
            </ul>
            {{ $movies->links("pagination::bootstrap-4") }}

        </div>
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item-swag text-center"><h1 class="display-6-sm text-black text-center">Nejlépe hodnocené:</h1></li>
                @foreach($bestRatedMovies as $movieR)
                    <li class="list-group-item text-center"><b><a href="/movie/{{ $movieR->movie->id }}">{{ $movieR->movie->name }}</a></b> ({{ $year = date('Y', strtotime($movieR->movie->release_date)) }}) - {{ round($movieR->average * 20) }}%</li>
                @endforeach
            </ul>
            {{ $bestRatedMovies->onEachSide(1)->links("pagination::bootstrap-4") }}
        </div>
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item-swag text-center"><h1 class="display-6 text-black text-center">Nejlepší uživatelé:</h1></li>
                 @foreach($bestUsers as $bestUser)
                    <li class="list-group-item text-center"><b><a href="/profile/{{ $bestUser->id }}">{{ $bestUser->name }}</a></b> ({{ $bestUser->points }} bodů)</li>
                @endforeach
            </ul>
        </div>
        </div>
    </div>
</div>
@endsection
