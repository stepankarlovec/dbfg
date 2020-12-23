<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome'); });
Auth::routes();

Route::get('/addMovie', [App\Http\Controllers\MovieController::class, 'add'])->name('addMovie')->middleware('auth');
Route::post('/addMovie', [App\Http\Controllers\MovieController::class, 'store']);

Route::get('/movie', [App\Http\Controllers\MovieController::class, 'index'])->name('listMovies');
Route::get('/movie/{movie}', [App\Http\Controllers\MovieController::class, 'show'])->name('showMovie');

Route::get('/person/{person}', [App\Http\Controllers\PersonController::class, 'show'])->name('showPerson');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
