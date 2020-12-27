@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('css/movieView.css') }}" rel="stylesheet" >
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 class="display-4">{{ $movie->name }}</h1>
            <div class="d-flex">
                <p class="">{{ $movie->genre }}</p>
                <p class="pl-2">{{ $year = date('Y', strtotime($movie->release_date)) }}</p>
                <p class="pl-2">{{ $movie->duration }} minut</p>
            </div>
            <p>Režisér:
                @foreach ($personsDir as $personDir)
                <a href="/person/{{ $personDir->id }}">{{$personDir->name}}</a>,
                @endforeach
            </p>
            <p>Hlavní představitelé:
                @foreach ($persons as $person)
                <a href="/person/{{ $person->id }}">{{$person->name}}</a>,
                @endforeach
            </p>
            <p>
                {{ substr(strip_tags($movie->about), 0, 250) }}
                @if (strlen($movie->about) > 250)
                    <span id="dots">...</span>
                    <span id="more">{{ substr($movie->about, 250) }}</span>
                @endif
                <a href="#showMore" onclick="myFunction()" id="read">Zobrazit více</a>
            </p>

            <div class="row">
                <div class="col-md-6">
                    <p>Hodnocení:</p>
                    <!-- NEJSPÍŠ BUDU MUSET PŘIDAT VUE PÍČOVINY -->
                    @auth
                    @if(isset($getUsersRating->rate))
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="5 hvězd">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="4 hvěždy">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="3 hvězdy">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="2 hvězdy">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="1 hvězda">1 star</label>
                            </div><br><br><br>
                            <p>Tvé hodnocení: {{ $getUsersRating->rate }} hvězdy/a</p>
                    @else
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="5 hvězd">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="4 hvěždy">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="3 hvězdy">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="2 hvězdy">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="1 hvězda">1 star</label>
                    </div>
                        @endif
                    @endauth
                    @guest
                        <p>Pro ohodnocení se musíte <a href="{{ route('login') }}">přihlásit</a>.</p>
                    @endguest
                </div>
                <div class="col-md-6">
                    <h1>{{ $rating->average * 20 }}%</h1>
                    <p>{{ $pocetHlasu = $rating->star1+$rating->star2+$rating->star3+$rating->star4+$rating->star5 }} hodnocení</p>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="/storage/{{ $movie->image }}">
        </div>
        <div class="d-flex col-md-2">
            @if($maxMovieId==$movie->id)
            @else
            <a href="/movie/{{ $movie->id +1}}">Další</a>
            @endif
            @if($minMovieId==$movie->id)
            @else
            <a class="ml-2"href="/movie/{{ $movie->id -1}}">Předchozí</a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">Přidal <a>{{$movie->addedUser}}</a></div>
    </div>
<div class="row pt-5">
    <div class="col-md-12">
        @auth
        <h1>Přidat komentář:</h1>
        <form method="post" class="col-md-6" action="{{ route('addMovieComment', $movie->id) }}">


        </form>
        @endauth
    </div>
</div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#star1").click(function(){
            let rating = 1;
            $.ajax({
                url: "{{ route('MovieAddRating', $movie->id) }}",
                type:"POST",
                data:{
                    rateNumber:rating,
                    movieId:{{$movie->id}},
                },
                success:function (response){
                    if(response){
                        alert("Successfully rated..");
                    }
                }
            });
            location.reload();
            return false;
        });
        $("#star2").click(function(){
            let rating = 2;
            $.ajax({
                url: "{{ route('MovieAddRating', $movie->id) }}",
                type:"POST",
                data:{
                    rateNumber:rating,
                    movieId:{{$movie->id}},
                },
                success:function (response){
                    if(response){
                        alert("Successfully rated..");
                    }
                }
            });
            location.reload();
            return false;
        });
        $("#star3").click(function(){
            let rating = 3;
            $.ajax({
                url: "{{ route('MovieAddRating', $movie->id) }}",
                type:"POST",
                data:{
                    rateNumber:rating,
                    movieId:{{$movie->id}},
                },
                success:function (response){
                    if(response){
                        alert("Successfully rated..");
                    }
                }
            });
            location.reload();
            return false;
        });
        $("#star4").click(function(){
            let rating = 4;
            $.ajax({
                url: "{{ route('MovieAddRating', $movie->id) }}",
                type:"POST",
                data:{
                    rateNumber:rating,
                    movieId:{{$movie->id}},
                },
                success:function (response){
                    if(response){
                    }
                }
            });
            location.reload();
            return false;
        });
        $("#star5").click(function(){
            let rating = 5;
            $.ajax({
                url: "{{ route('MovieAddRating', $movie->id) }}",
                type:"POST",
                data:{
                    rateNumber:rating,
                    movieId:{{$movie->id}},
                },
                success:function (response){
                    if(response){
                    }
                }
            });
            location.reload();
            return false;
        });
    });


</script>
<script src="{{ asset('js/movieView.js') }}"></script>

@endsection
