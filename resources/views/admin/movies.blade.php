@extends('admin.index')
@section('AdminContent')
    <div class="container">
        <div class="row">
        <div class="col-md-6">
            <h1 class="display-6">Nejnovější přidané:</h1>
            <ul class="list-group">
                @foreach($movies as $movie)
                    <li class="list-group-item bg-dark"><b><a href="/movie/{{ $movie->id }}">{{ $movie->name }}</a></b> ({{ $year = date('Y', strtotime($movie->release_date)) }})
                            <a href="{{ route('adminApproveMovie', $movie->id) }}" class="btn-sm btn btn-warning ml-3">Odebrat</a>
                            <a href="{{ route('editMovie', $movie->id) }}" class="btn-sm btn btn-secondary">Upravit</a>
                            <a href="{{ route('deleteMovie', $movie->id) }}" class="btn-sm btn btn-danger">Odstranit</a>
                    </li>
                @endforeach
            </ul>
            {{ $movies->links("pagination::bootstrap-4") }}
        </div>
            <div class="col-md-4">
                <h1 class="display-6">Uživatelé:</h1>
                <ul class="list-group">
                    @foreach($users as $user)
                        <li class="list-group-item bg-dark"><b><a href="/profile/{{ $user->id }}">{{ $user->name }}</a></b>
                            <a href="#" class="btn-sm btn btn-warning ml-3">Ban</a>
                            <a href="#" class="btn-sm btn btn-danger">Delete</a>
                        </li>
                    @endforeach
                </ul>
                {{ $movies->links("pagination::bootstrap-4") }}
            </div>
        <div class="col-md-2">
            <h1 class="display-6">Statistiky:</h1>
            <p>
                Počet filmů: <b>{{ $allMovies }}</b><br>
                Počet hodnocení: <b>{{ $allRatings }}</b><br>
                Počet uživatelů: <b>{{ $allUsers }}</b>
            </p>
        </div>
        </div>
    </div>
@endsection
