@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/movieView.css') }}" rel="stylesheet" >
<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            @auth
                @if(auth()->user()->admin==1)
                    <a href="{{ route('editMovie', $movie->id) }}" class="text-secondary">edit</a> |
                    <a href="{{ route('deleteMovie', $movie->id) }}" class="text-danger">delete</a> |
                    <a href="{{ route('addToSelected', $movie->id) }}" class="text-primary">select</a>
                @endif
            @endauth

            <div class="d-flex">
                <h1 class="display-4">{{ $movie->name }}</h1>
                @auth
                <button type="submit" id="favoriteButton">🖤</button>
                @endauth
            </div>

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
                    <h1>{{ round($rating->average * 20) }}%</h1>
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
        <div class="col-md-6">Přidal <a href="{{ route('showProfile', \App\Models\User::find($movie->addedUser)->id) }}">{{ \App\Models\User::find($movie->addedUser)->name }}</a></div>
    </div>
    <div class="row pt-2">
    @auth
        @if(!isset($commentExists) && isset($getUsersRating->rate))
        <div class="col-md-12">
            <hr></hr>
                <div class="row">
                <div class="col-md-6">
            <h1>Přidat komentář:</h1>
            <form method="post" action="{{ route('addComment', $movie->id) }}">
                @csrf
                <textarea name="comment" class="form-control" placeholder="Zanechte váš názor.." rows="3"></textarea>
                <input type="submit" class="btn btn-success mt-1">
            </form>
                </div>
                </div>
        </div>
            @endif
            @endauth
    <div class="col-md-12">
        <hr></hr>
        @if(count($comments)>0)
        <h1 class="display-6">Komentáře:</h1>
        @if(auth()->check() & isset($commentExists))
                <div class="d-inline-flex">
                    <a class="font-weight-bolder commentName pb-1" href="/profile/{{ $commentExists->user->id }}">{{ $commentExists->user->name }}</a>
                    <div class="pl-2 paddingT3">{{ $commentExists->user->ratings->where('movie_id', $movie->id)->first()->rate }} hvězd/y</div>
                    <div class="pl-1">
                        <button id="likeComment{{$commentExists->id}}" class="thumbbutton" type="submit">👍</button>
                        <button id="dislikeComment{{$commentExists->id}}" class="thumbbutton" type="submit">👎</button>
                    </div>
                    @auth
                            <div class="paddingT3 pl-2">
                                <a href="{{ route('editComment', $movie->id) }}" class="text-secondary">Upravit</a>
                                <a href="{{ route('deleteComment', $movie->id) }}" class="text-danger pl-2">Odstranit</a>
                            </div>
                    @endauth
                </div>
                <p>{{ $commentExists->content }}</p>
            @endif
        @foreach($comments as $comment)
                @if(auth()->check() && isset($commentExists) && $comment->id == $commentExists->id)
                @else
            <div class="d-inline-flex">
                <a class="font-weight-bolder commentName pb-1" href="/profile/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                <div class="pl-2 paddingT3">{{ $comment->user->ratings->where('movie_id', $movie->id)->first()->rate }} hvězd/y</div>
                <div class="pl-1">
                    <button id="likeComment{{$comment->id}}" class="thumbbutton" type="submit">👍</button>
                    <button id="dislikeComment{{$comment->id}}" class="thumbbutton" type="submit">👎</button>
                </div>
                @auth
                    @can('update', $comment)
                        <div class="paddingT3 pl-2">
                            <a href="{{ route('editComment', $movie->id) }}" class="text-secondary">Upravit</a>
                            <a href="{{ route('deleteComment', $movie->id) }}" class="text-danger pl-2">Odstranit</a>
                        </div>
                    @endcan
                @endauth
            </div>
                <p>{{ $comment->content }}</p>
                @endif
        @endforeach
            @endif
    </div>
</div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        @if($movieIsFavorite==!null)
        $("#favoriteButton").html('❤️');
        @else
        $("#favoriteButton").html('🖤');
        @endif
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#favoriteButton").click(function(){
            var value = $("#favoriteButton").text();
            if(value==="🖤"){
                $("#favoriteButton").html('❤️');
            }else{
                $("#favoriteButton").html('🖤');
            }
            $.ajax({
                url: "{{ route('movieFavorite', $movie->id) }}",
                type:"GET",
                data:{
                },
                success:function (response){
                    if(response){
                    }
                }
            });
            location.reload();
            return false;
        });
        @if(count($comments)>0)
            @foreach($comments as $comment)
        $("#likeComment{{$comment->id}}").click(function(){
            $.ajax({
                url: "{{ route('likeComment', $comment->id) }}",
                type:"POST",
                data:{
                    likeOrDis:1,
                    comment_id:{{$comment->id}},
                    movie_id:{{$movie->id}},
                },
                success:function (response){
                    if(response){
                    }
                }
            });
            location.reload();
            return false;
        });
        $("#dislikeComment{{$comment->id}}").click(function(){
            $.ajax({
                url: "{{ route('likeComment', $comment->id) }}",
                type:"POST",
                data:{
                    likeOrDis:0,
                    comment_id:{{$comment->id}},
                    movie_id:{{$movie->id}},
                },
                success:function (response){
                    if(response){
                    }
                }
            });
            location.reload();
            return false;
        });
        @endforeach
        @endif
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
