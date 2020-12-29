<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    // zkusím využít Scout
    public function search($search){
        return dd($search);
    }
}
