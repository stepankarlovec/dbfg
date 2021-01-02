<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use App\Models\MovieRating;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class AdminController extends Controller
{
    public function index(\App\Models\Movie $movie){
        if(!Auth::check()){
            redirect(route('login'));
        }
        if(!\auth()->user()->admin == 1){
            redirect(route('login'));
        }

        $movies = Movie::where('validate', 1)->paginate(10);
        $users = User::orderByDesc('id')->paginate(10);

        $allMovies = Movie::all()->count();
        $allUsers = User::all()->count();
        $allRatings = Rating::all()->count();
        return view('admin.movies', compact('movies', 'users', 'allMovies', 'allUsers', 'allRatings'));
    }
    public function edit(\App\Models\Movie $movie){
        return view('admin.edit', compact('movie'));
    }
    public function approve(){
        $movies = Movie::where('validate', 0)->paginate(10);
        return view('admin.approve', compact('movies'));
    }
    public function approveMovie(\App\Models\Movie $movie){
        if($movie->validate==0){
            Movie::where('id', $movie->id)->update(['validate' => 1]);
            return redirect(route('adminApprove'));
        }elseif($movie->validate==1){
            Movie::where('id', $movie->id)->update(['validate' => 0]);
            return redirect(route('indexAdmin'));
        }
    }
    public function update(\App\Models\Movie $movie, Request $request){
        $data = \request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'genre' => ['nullable','string', 'max:255'],
            'release_date' => ['required', 'date'],
            'duration' => ['nullable','integer'],
            'director' => ['nullable','string', 'max:255'],
            'actors' => ['nullable','string', 'max:255'],
            'about' => ['nullable','string'],
            'image' => [''],
            'addedUser' => ['nullable','string'],
        ]);
        if(\request('image')){
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(500, 600);
            $image->save();
            $data = array_merge($data, ['image' => $imagePath]);
        }
        $movie->update($data);
        return redirect(route('indexAdmin'));
    }
    public function delete(\App\Models\Movie $movie){
        $delCasts = Cast::where('movie', $movie->id)->delete();
        $delRating = Rating::where('movie_id', $movie->id)->delete();
        $delMovRating = MovieRating::where('movie_id', $movie->id)->delete();
        $delMovie = Movie::where('id', $movie->id)->delete();
        return redirect(route('adminApprove'));
    }

}
