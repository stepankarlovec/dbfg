@extends('layouts.app')

@section('content')

<div class="container">
    @auth
        <div class="row">
    <form method="post" class="col-md-6" enctype="multipart/form-data" action="{{ route('addMovie') }}">
        @csrf
        <div class="my-1">
            <label for="genre" class="ml-1">Název filmu: *</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}" required autocomplete="name" autofocus placeholder="Pelíšky">

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Země původu:</label>
            @include('layouts.countrylist')
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Žánr:</label>
            <input id="genre" type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre') }}"  autocomplete="genre" autofocus placeholder="Komedie / Drama">
            @error('genre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Datum vydání: *</label>
            <input id="release_date" type="date" class="form-control @error('release_date') is-invalid @enderror" name="release_date" value="{{ old('release_date') }}" required autocomplete="release_date" autofocus placeholder="release date">

            @error('release_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Délka filmu: (min)</label>
            <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}"  autocomplete="duration" autofocus placeholder="116">

            @error('duration')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Režisér:</label>
            <input id="director" type="text" class="form-control @error('director') is-invalid @enderror" name="director" value="{{ old('director') }}"  autocomplete="director" autofocus placeholder="Jan Hřebejk">

            @error('director')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Hlavní herci:</label>
            <input id="actors" type="text" class="form-control @error('actors') is-invalid @enderror" name="actors" value="{{ old('actors') }}"  autocomplete="actors" autofocus placeholder="Miroslav Donutil, Jiří Kodet, Simona Stašová, Emília Vášáryová, Bolek Polívka">
            @error('actors')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Popis filmu:</label>
            <textarea rows="5" id="about" class="form-control @error('about') is-invalid @enderror" name="about" value="{{ old('about') }}"  autocomplete="about" autofocus placeholder="Děj je zasazen do konce šedesátých let - podzim 67 až léto 68 s krátkým epilogem přesahujícím do let sedmdesátých. Pražská vilová čtvrť Hanspaulka, jemná poetika a humorná nadsázka jsou charakteristické pro mozaikové vyprávění paralelních životních osudů tří generací mužů a žen ve zvláštním období našich dějin v roce 1968..">
            </textarea>

            @error('about')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Plakát:</label><br>
            <input id="image" type="file" class="file-form-control" name="image" value="{{ old('image') }}" autocomplete="image" autofocus placeholder="Main image">

            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-2">
        <input type="submit" class="btn btn-success">
        </div>
    </form>
    @endauth
    @guest
    <p>You need to <a href="{{ route('login') }}">log-in</a></p>
    @endguest
    <div class="col-md-6">
        <h1>Přidávání filmů</h1>
        <p>Chtěli by jste na DBFG přidat nový film? Můžete si o něj požádat v tomto formuláři. Stačí zadat název filmu, datum vydání a vaši prosbu zaregistrujeme. Pokud nám ovšem chcete ulehčit práci, můžete informace o filmu předvyplnit - film se na DBFG dostane dřív a pod filmem dostanete speciální poděkování za přidání filmu.</p>
        <p>- Předvyplněný text slouží jako ukázka.<br>- Jména musí být oddělena čárkou s mezerou jako tomu je v ukázce!</p>
        <p>Formulář se po odeslání pošle ke schválení. Pokud film projde začne se zobrazovat na stránce.</p>
    </div>
</div>

@endsection
