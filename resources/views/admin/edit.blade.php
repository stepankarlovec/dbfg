@extends('layouts.app')
@section('content')
    <form method="post" class="col-md-6" enctype="multipart/form-data" action="{{ route('updateMovie', $movie->id) }}">
        @csrf
        @method('PATCH')
        <div class="my-1">
            <label for="genre" class="ml-1">Název filmu: *</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $movie->name }}" required autocomplete="name" autofocus placeholder="Pelíšky">

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
            <input id="genre" type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre') ?? $movie->genre }}"  autocomplete="genre" autofocus placeholder="Komedie / Drama">
            @error('genre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Datum vydání: *</label>
            <input id="release_date" type="date" class="form-control @error('release_date') is-invalid @enderror" name="release_date" value="{{ old('release_date') ?? $movie->release_date }}" required autocomplete="release_date" autofocus placeholder="release date">

            @error('release_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Délka filmu: (min)</label>
            <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') ?? $movie->duration }}"  autocomplete="duration" autofocus placeholder="116">

            @error('duration')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Režisér:</label>
            <input id="director" type="text" class="form-control @error('director') is-invalid @enderror" name="director" value="{{ old('director') ?? $movie->director }}"  autocomplete="director" autofocus placeholder="Jan Hřebejk">

            @error('director')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Hlavní herci:</label>
            <input id="actors" type="text" class="form-control @error('actors') is-invalid @enderror" name="actors" value="{{ old('actors') ?? $movie->actors}}"  autocomplete="actors" autofocus placeholder="Miroslav Donutil,Jiří Kodet,Simona Stašová,Emília Vášáryová,Bolek Polívka">

            @error('actors')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Popis filmu:</label>
            <textarea rows="5" id="about" class="form-control @error('about') is-invalid @enderror" name="about" autocomplete="about" autofocus placeholder="Děj je zasazen do konce šedesátých let - podzim 67 až léto 68 s krátkým epilogem přesahujícím do let sedmdesátých. Pražská vilová čtvrť Hanspaulka, jemná poetika a humorná nadsázka jsou charakteristické pro mozaikové vyprávění paralelních životních osudů tří generací mužů a žen ve zvláštním období našich dějin v roce 1968..">{{ old('about') ?? $movie->about }}
            </textarea>

            @error('about')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="my-1">
            <label for="genre" class="ml-1">Plakát:</label><br>
            <input id="image" type="file" class="file-form-control" name="image" value="{{ old('image') ?? $movie->image }}" autocomplete="image" autofocus placeholder="Main image">

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
@endsection
