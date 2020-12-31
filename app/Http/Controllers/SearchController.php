<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Person;
use App\Models\User;
use Illumiante\Support\Facades\File;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // zkusím využít Scout
    public function index(Request $request){
        $movies = Movie::where('name','LIKE', '%'.$request->search.'%')->paginate(10);
        $persons = Person::where('name','LIKE', '%'.$request->search.'%')->paginate(10);
        $users = User::where('name','LIKE', '%'.$request->search.'%')->paginate(10);
        return view('search.index',compact('movies', 'persons', 'users'));
    }
}
