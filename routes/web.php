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

Route::get('/', function () {return view('welcome'); })->name('welcome');
Auth::routes();

Route::get('/search/{search}', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

Route::get('/addMovie', [App\Http\Controllers\MovieController::class, 'add'])->name('addMovie')->middleware('auth');
Route::post('/addMovie', [App\Http\Controllers\MovieController::class, 'store']);

Route::get('/movie', [App\Http\Controllers\MovieController::class, 'index'])->name('listMovies');
Route::get('/movie/{movie}', [App\Http\Controllers\MovieController::class, 'show'])->name('showMovie');
Route::post('/movie/{movie}/rating', [App\Http\Controllers\MovieController::class, 'rate'])->name('MovieAddRating');
Route::post('/movie/{movie}/comment', [App\Http\Controllers\MovieController::class, 'rate'])->name('addMovieComment');


Route::get('/person/{person}', [App\Http\Controllers\PersonController::class, 'show'])->name('showPerson');
Route::get('/admin/panel', [App\Http\Controllers\AdminController::class, 'index'])->name('indexAdmin')->middleware('admin');
Route::get('/admin/{movie}/delete', [App\Http\Controllers\AdminController::class, 'delete'])->name('deleteMovie')->middleware('admin');
Route::get('/admin/{movie}/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('editMovie')->middleware('admin');
Route::patch('/admin/{movie}/edit', [App\Http\Controllers\AdminController::class, 'update'])->name('updateMovie')->middleware('admin');
Route::get('/admin/approve', [App\Http\Controllers\AdminController::class, 'approve'])->name('adminApprove')->middleware('admin');
Route::get('/admin/{movie}/approve', [App\Http\Controllers\AdminController::class, 'approveMovie'])->name('adminApproveMovie')->middleware('admin');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
