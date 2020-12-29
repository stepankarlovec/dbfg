@extends('layouts.app')

@section('content')
<head>
    <link href="{{ asset('css/adminView.css') }}" rel="stylesheet" >
</head>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Administrace DBFG </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('indexAdmin') }}" class="list-group-item list-group-item-action bg-dark text-white">Domů</a>
                <a href="{{ route('adminApprove') }}" class="list-group-item list-group-item-action bg-dark text-white">Ke schválení</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Uživatelé</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Events</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Profile</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Status</a>
            </div>
        </div>
        @yield('AdminContent')
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
@endsection
