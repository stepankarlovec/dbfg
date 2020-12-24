@extends('layouts.app')

@section('content')
<div>
    <div class="jumbotron">
        <h1 class="display-4">Jaký film si vyberete dnes?</h1>
        <p>Na naší stránce FakeČSFD si určitě vyberete..</p>
    </div>
    <div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <h1 class="display-6">Anna maria na útěku</h1>
            <p>2020</p>
        </div>
        <div class="col-3">
            <h1 class="display-6">Anna maria na útěku</h1>
            <p>2020</p>
        </div>
        <div class="col-3">
            <h1 class="display-6">Anna maria na útěku</h1>
            <p>2020</p>
        </div>
        <div class="col-3">
            <h1 class="display-6">Anna maria na útěku</h1>
            <p>2020</p>
        </div>
    </div>
    <hr />
    </div>
    <div class="container">
        <div class="row">
        <div class="col-md-4">
            <h1 class="display-6 text-center">Nejnovější přidané:</h1>
            <ul class="list-group">
            @foreach($movies as $movie)
                <li class="list-group-item text-center"><b><a href="/movie/{{ $movie->id }}">{{ $movie->name }}</a></b> - {{ $year = date('Y', strtotime($movie->release_date)) }}</li>
            @endforeach
            </ul>
            {{ $movies->links("pagination::bootstrap-4") }}

        </div>
        <div class="col-md-4">
            <h1 class="display-6 text-center">Nejlépe hodnocené:</h1>
            <ul class="list-group">
                <li class="list-group-item text-center"><b>Tři oříšky pro popelku</b> - 2020</li>
            </ul>
        </div>
        <div class="col-md-4">
            <h1 class="display-6 text-center">Náš výběr:</h1>
            <ul class="list-group">
                <li class="list-group-item text-center"><b>Tři oříšky pro popelku</b> - 2020</li>
            </ul>
        </div>
        </div>
    </div>
</div>
@endsection
