@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @auth
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Upravit - {{ $person->name }}:</h1>
                            <form method="post" enctype="multipart/form-data" action="{{ route('editPatchPerson', $person->id) }}">
                                @method('PATCH')
                                @csrf
                                <label for="image" class="pt-2">Datum narození:</label>
                                <input type="date" name="birth" class="form-control @error('birth') is-invalid @enderror" placeholder="Jméno" value="{{ $person->birth }}">
                                <label for="image" class="pt-2">Místo narození:</label>
                                <input type="text" name="birth_place" class="form-control @error('birth_place') is-invalid @enderror" placeholder="Místo narození" value="{{ $person->birth_place }}">
                                <label for="image" class="pt-2">Životopis / Popis umělce:</label>
                                <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" placeholder="Životopis / Popis umělce" rows="3">{{ $person->bio }}</textarea>
                                <label for="image" class="pt-2">Obrázek:</label>
                                <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" value="{{ $person->image }}">
                                <input type="submit" class="btn btn-success mt-2">
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
