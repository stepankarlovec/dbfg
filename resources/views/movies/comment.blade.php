@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            @auth
                <div class="row">
                    <div class="col-md-6">
                        <h1>Upravit komentář u <a href="/movie/{{ $movie->id }}">{{ $movie->name }}</a>:</h1>
                        <form method="post" action="{{ route('editCommentPatch', $movie->id) }}">
                            @method('PATCH')
                            @csrf
                            <textarea name="comment" class="form-control" placeholder="Zanechte váš názor.." rows="3">{{ $oldComment->content }}</textarea>
                            <input type="submit" class="btn btn-success mt-1">
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
@endsection
