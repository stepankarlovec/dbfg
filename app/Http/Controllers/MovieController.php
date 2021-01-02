<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Comment;
use App\Models\FavoriteMovie;
use App\Models\Rating;
use App\Models\MovieRating;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Person;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index(){
        $movies = Movie::orderByDesc('id')->where('validate', 1)->paginate(5, ['*'], 'pL');
        $bestRatedMovies = MovieRating::orderByDesc('average')->whereHas('movie', function ($query) {
            return $query->where('validate', '=', 1);
        })->paginate(5, ['*'], 'pR');
        $bestUsers = User::orderByDesc('points')->paginate(5, ['*'], 'bU');
        return view('movies/mainMovies', compact('movies', 'bestRatedMovies', 'bestUsers'));
    }
    public function add(){
        return view('movies/addMovie');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'genre' => ['nullable','string', 'max:255'],
            'release_date' => ['required', 'date'],
            'duration' => ['nullable','integer'],
            'director' => ['nullable','string', 'max:255'],
            'actors' => ['nullable','string', 'max:255'],
            'about' => ['nullable','string'],
            'image' => ['image'],
        ]);
        // Rozdělení herců do array
        $imageArr=explode(", ",$request['actors']);
        $directorArr=explode(", ",$request['director']);

        // DIRECTOR EXISTS
        $directorExists = DB::table('persons')->whereIn('name', $directorArr)->get();
        // Lepší  způsob pomocí metody ::firstOrCreate ale nechce se mi to přepisovat xD
        for($i=0;$i < count($directorArr); $i++){
            $personValid = false;
            $personMaxId = Person::max('id') + 1;
            $movieMaxId = Movie::max('id') + 1;
            for($d=0;$d < count($directorExists);$d++){
                if ($imageArr[$i] == $directorExists[$d]->name) {
                    Cast::create([
                        'movie' => $movieMaxId,
                        'person' => $directorExists[$d]->id,
                        'role' => 'herec',
                    ]);
                    $personValid = true;
                    break;
                }
            }
            if($personValid==true){
                continue;
            }
            Person::create([
                'name' => $directorArr[$i],
            ]);
            Cast::create([
                'movie' => $movieMaxId,
                'person' => $personMaxId,
                'role' => 'režisér',
            ]);
        }

        $personValid=false;
        // asi by to šlo pomocí metody ::firstOrCreate ale nechce se mi to přepisovat xD - je to složitější
        // PERSON EXISTS
        $personExists = DB::table('persons')->whereIn('name', $imageArr)->get();
        for($i=0;$i < count($imageArr); $i++){
            $personValid = false;
            $personMaxId = Person::max('id') + 1;
            $movieMaxId = Movie::max('id') + 1;
            for($d=0;$d < count($personExists);$d++){
                if ($imageArr[$i] == $personExists[$d]->name) {
                    Cast::create([
                        'movie' => $movieMaxId,
                        'person' => $personExists[$d]->id,
                        'role' => 'herec',
                    ]);
                    $personValid = true;
                    break;
                }
            }
            if($personValid==true){
                continue;
            }
            Person::create([
                'name' => $imageArr[$i],
            ]);
            Cast::create([
                'movie' => $movieMaxId,
                'person' => $personMaxId,
                'role' => 'herec',
            ]);
        }

        $addedUser = 0;
        // Image zpracování a Movie create
        if ($request['genre']!=null & $request['duration']!=null & $request['director']!=null & $request['actors']!=null & $request['about']!=null & $request['image']!=null){
            $goodUser = User::find(\auth()->user()->id);
            $newPoints = $goodUser->points + 50;
            $goodUser->points = $newPoints;
            $goodUser->save();
            $addedUser = $goodUser->id;
        }
        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');
            // Image error - its working VScode is just stoopid.
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(500, 600);
            $image->save();
            Movie::create([
                'name' => $request['name'],
                'genre' => $request['genre'],
                'release_date' => $request['release_date'],
                'duration' => $request['duration'],
                'director' => $request['director'],
                'actors' => $request['actors'],
                'about' => $request['about'],
                'image' => $imagePath,
                'addedUser' => $addedUser,
        ]);
        }else{
            Movie::create([
                'name' => $request['name'],
                'genre' => $request['genre'],
                'release_date' => $request['release_date'],
                'duration' => $request['duration'],
                'director' => $request['director'],
                'actors' => $request['actors'],
                'about' => $request['about'],
                'addedUser' => $addedUser,
            ]);
        }
        $movieMaxId = Movie::max('id');
        MovieRating::create([
            'movie_id' => $movieMaxId,
        ]);
        return redirect()->route('home');
    }
    public function show(\App\Models\Movie $movie){
        if($movie->validate == 0){
            abort(404);
        }
        $rating = MovieRating::find($movie->id);

        $comments = Comment::where('movie_id', $movie->id)->orderBy('rating', 'DESC')->with('user')->paginate(6);

        $maxMovieId = Movie::max('id');
        $minMovieId = Movie::min('id');

        $castsDir = DB::table('casts')->where('movie', $movie->id)->where('role', 'režisér')->pluck('person');
        $personsDir = DB::table('persons')->whereIn('id', $castsDir)->get();

        $casts = DB::table('casts')->where('movie', $movie->id)->where('role', 'herec')->pluck('person');
        $persons = DB::table('persons')->whereIn('id', $casts)->get();
        $movieIsFavorite = null;
        if(Auth::check()){
            $movieIsFavorite = FavoriteMovie::where(['movie_id' => $movie->id, 'user_id' => auth()->user()->id])->first();
            $commentExists = Comment::where(['movie_id' => $movie->id, 'user_id' => auth()->user()->id])->first();
            $getUsersRating = DB::table('ratings')->where('user_id', auth()->user()->id)->where('movie_id', $movie->id)->first();
        }else{
            $getUsersRating = "Pro hlasování se musíte přihlásit.";
            $commentExists = 0;
        }

        return view('movies.showMovie', compact('movie', 'persons', 'personsDir', 'comments', 'maxMovieId', 'minMovieId', 'rating', 'getUsersRating', 'commentExists', 'movieIsFavorite'));
    }

    public function rate(Request $request){
        if(!Auth::check()){
            redirect(route('login'));
        }else {
            $rating = $request['rateNumber'];
            // nebere movie ID hmm... zkus změnit v ajaxu movie_id POROVNEJ z githubem ;) ;)
            $movie_id = $request['movieId'];
            $userId = auth()->user();
            // logika k vypočítání průměru, vynásobení ratu s počtem odpovědí, sečíst vše dohromady a vydělit celkovým počtem odpovědí.
                if($beforeRate = Rating::where('user_id', $userId->id)->where('movie_id', $movie_id)->first()){
                    $canSwitch = true;
                }else{
                    $canSwitch = false;
                }
            Rating::updateOrCreate(
                ['movie_id' => $movie_id, 'user_id' => $userId->id],
                ['rate' => $rating]
            );
            // potřebuji v DB nastavit primární klíč movie_id a pak použít metodu ::find 24.12
            $beforeRating = MovieRating::find($movie_id);
            if($canSwitch==true) {
                switch ($beforeRate->rate) {
                    case 1:
                        $beforeRating->star1 -= 1;
                        break;
                    case 2:
                        $beforeRating->star2 -= 1;
                        break;
                    case 3:
                        $beforeRating->star3 -= 1;
                        break;
                    case 4:
                        $beforeRating->star4 -= 1;
                        break;
                    case 5:
                        $beforeRating->star5 -= 1;
                        break;
                }
            }
            switch ($rating){
                case 1:
                    $beforeRating->star1 += 1;
                    break;
                case 2:
                    $beforeRating->star2 += 1;
                    break;
                case 3:
                    $beforeRating->star3 += 1;
                    break;
                case 4:
                    $beforeRating->star4 += 1;
                    break;
                case 5:
                    $beforeRating->star5 += 1;
                    break;
            }
            $delitel = $beforeRating->star1+$beforeRating->star2+$beforeRating->star3+$beforeRating->star4+$beforeRating->star5;
            $vypocet = ($beforeRating->star1*1+$beforeRating->star2*2+$beforeRating->star3*3+$beforeRating->star4*4+$beforeRating->star5*5)/$delitel;
            MovieRating::where('movie_id', $movie_id)->update([
                'average' => $vypocet,
                'star1' => $beforeRating->star1,
                'star2' => $beforeRating->star2,
                'star3' => $beforeRating->star3,
                'star4' => $beforeRating->star4,
                'star5' => $beforeRating->star5,
            ]);
            $userId->points = $userId->points + 1;
            $userId->save();
        }

    }
    public function favorite(Movie $movie){
        $result = FavoriteMovie::where(['movie_id' => $movie->id, 'user_id' => auth()->user()->id])->first();
        if($result === null || !$result){
            FavoriteMovie::create(['movie_id' => $movie->id, 'user_id' => auth()->user()->id]);
        }else{
            FavoriteMovie::where(['movie_id' => $movie->id, 'user_id' => auth()->user()->id])->first()->delete();
        }
    }

}
