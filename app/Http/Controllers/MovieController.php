<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Rating;
use App\Models\MovieRating;
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
        // $movies = Movie::all()->paginate(5);
        $movies = DB::table('movies')->orderBy('id', 'desc')->paginate(5);
        return view('movies/mainMovies', compact('movies'));
    }
    public function add(){
        return view('movies/addMovie');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'release_date' => ['required', 'date'],
            'duration' => ['required', 'integer'],
            'director' => ['required', 'string', 'max:255'],
            'actors' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string'],
            'image' => ['image'],
        ]);
        // Rozdělení herců do array
        $imageArr=explode(",",$request['actors']);
        $directorArr=explode(",",$request['director']);

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

        // Image zpracování a Movie create
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
        ]);
        }
        $movieMaxId = Movie::max('id');
        MovieRating::create([
            'movieId' => $movieMaxId,
        ]);
        return redirect()->route('home');
    }
    public function show(\App\Models\Movie $movie){
        $rating = MovieRating::find($movie->id);

        $maxMovieId = Movie::max('id');
        $minMovieId = Movie::min('id');

        $castsDir = DB::table('casts')->where('movie', $movie->id)->where('role', 'režisér')->pluck('person');
        $personsDir = DB::table('persons')->whereIn('id', $castsDir)->get();

        $casts = DB::table('casts')->where('movie', $movie->id)->where('role', 'herec')->pluck('person');
        $persons = DB::table('persons')->whereIn('id', $casts)->get();

        $getUsersRating = DB::table('ratings')->where('userId', auth()->user()->id)->where('movieId', $movie->id)->first();

        return view('movies.showMovie', compact('movie', 'persons', 'personsDir', 'maxMovieId', 'minMovieId', 'rating', 'getUsersRating'));
    }

    public function rate(Request $request){
        if(!Auth::check()){
            redirect(route('login'));
        }else {
            $rating = $request['rateNumber'];
            $movieId = $request['movieId'];
            $userId = auth()->user()->id;
            // logika k vypočítání průměru, vynásobení ratu s počtem odpovědí, sečíst vše dohromady a vydělit celkovým počtem odpovědí.
                if($beforeRate = Rating::where('userId', $userId)->where('movieId', $movieId)->first()){
                    $canSwitch = true;
                }else{
                    $canSwitch = false;
                }
            Rating::updateOrCreate(
                ['movieId' => $movieId, 'userId' => $userId],
                ['rate' => $rating]
            );
            // potřebuji v DB nastavit primární klíč movieId a pak použít metodu ::find 24.12
            $beforeRating = MovieRating::find($movieId);
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
            MovieRating::where('movieId', $movieId)->update([
                'average' => $vypocet,
                'star1' => $beforeRating->star1,
                'star2' => $beforeRating->star2,
                'star3' => $beforeRating->star3,
                'star4' => $beforeRating->star4,
                'star5' => $beforeRating->star5,
            ]);
        }

    }

}
