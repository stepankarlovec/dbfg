@extends('layouts.app')

@section('content')
@guest
    <h1>Please <a href="{{route('login')}}">log-in</a>..</h1>
@endguest
    @auth
        <div class="container">
        <div class="row">
        <form action="{{ route('checkAdminPass') }}" method="POST" class="form-group col-md-4 align-items-center">
            @csrf
            <p class="alert alert-info">Musíme být ujištěni že jste skutečně admin.</p>
            <label for="adminPassword">Heslo:</label>
            <input type="password" name="adminPassword" class="form-control">
            <input type="submit" class="mt-1 btn btn-outline-primary" value="Přihlásit se">
        </form>
        </div>
        </div>
    @endauth
@endsection
