@extends('layouts.app')

@section('content')
<div class="container pt-1 text-white">
    <h1 class="display-6">Rozcestník</h1>
    <a href="{{ route('login') }}">login</a><br>
    <a href="{{ route('register') }}">register</a><br>
    <a href="{{ route('addMovie') }}">add movie</a><br>
    <a href="{{ route('listMovies') }}">úvodní stránka</a><br>
    <a href="{{ route('indexAdmin') }}">administrace</a>
</div>
@endsection


