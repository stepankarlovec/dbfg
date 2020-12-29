@extends('admin.index')
@section('AdminContent')
    <div class="container">
        <div class="col-md-12">
            <h1 class="display-6">Ke schválení:</h1>
            <table class="table text-white">
            <thead>
            <tr>
                <th scope="col">Název</th>
                <th scope="col">Žánr</th>
                <th scope="col">Délka</th>
                <th scope="col">Režisér</th>
                <th scope="col">Herci</th>
                <th scope="col">Možnosti</th>
            </tr>
            </thead>
                <tbody>
                @foreach($movies as $movie)
                <tr>
                    <td><b><a href="/movie/{{ $movie->id }}">{{ $movie->name }}</a></b> ({{ $year = date('Y', strtotime($movie->release_date)) }})</td>
                    <td>{{ $movie->genre }}</td>
                    <td>{{ $movie->duration }} minut</td>
                    <td>{{ $movie->director }}</td>
                    <td>{{ substr($movie->actors, 0, 150) }}</td>
                    <td>
                        <ul class="list-group">
                            <li class="list-inline-item"><a id="accept{{$movie->id}}" href="{{ route('adminApproveMovie', $movie->id) }}" class="btn-sm btn btn-success">Přijmout</a></li>
                            <li class="list-inline-item"><a id="edit{{$movie->id}}" href="{{ route('editMovie', $movie->id) }}" class="btn-sm btn btn-secondary">Upravit</a></li>
                            <li class="list-inline-item"><a id="delete{{$movie->id}}" href="{{ route('deleteMovie', $movie->id) }}" class="btn-sm btn btn-danger">Odstranit</a></li>
                        </ul>
                    </td>

                </tr>
                @endforeach
                </tbody>
            {{ $movies->links("pagination::bootstrap-4") }}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
@endsection
