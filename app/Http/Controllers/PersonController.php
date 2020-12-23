<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    // PersonController - directors, actors etc..
    public function show(\App\Models\Person $person){
        // $casts = DB::table('casts')->where('person', '=', $person->id)->get();
        // for($i=0;$i<count($casts);$i++){
        //     $movies = DB::table('movies')->where('id', '=', $casts[$i]->movie)->get();
        // }
        $casts = DB::table('casts')->where('person', $person->id)->pluck('movie');
        $movies = DB::table('movies')->whereIn('id', $casts)->get();
        return view('person.showPerson', compact('person', 'movies'));
    }
    public function edit(){
        
    }
}