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


Route::get('/addMovie', [App\Http\Controllers\MovieController::class, 'add'])->name('addMovie')->middleware('auth');
Route::post('/addMovie', [App\Http\Controllers\MovieController::class, 'store']);

Route::get('/movie', [App\Http\Controllers\MovieController::class, 'index'])->name('listMovies');
Route::get('/movie/{movie}', [App\Http\Controllers\MovieController::class, 'show'])->name('showMovie');
Route::post('/movie/{movie}/rating', [App\Http\Controllers\MovieController::class, 'rate'])->name('MovieAddRating')->middleware('auth');
Route::post('/comment/{movie}', [App\Http\Controllers\CommentController::class, 'index'])->name('addComment')->middleware('auth');;
Route::get('/comment/{movie}/edit', [App\Http\Controllers\CommentController::class, 'edit'])->name('editComment')->middleware('auth');;
Route::patch('/comment/{movie}/edit', [App\Http\Controllers\CommentController::class, 'patch'])->name('editCommentPatch')->middleware('auth');;
Route::get('/comment/{movie}/delete', [App\Http\Controllers\CommentController::class, 'delete'])->name('deleteComment')->middleware('auth');;
Route::post('/commentLike/{comment}', [App\Http\Controllers\CommentController::class, 'like'])->name('likeComment')->middleware('auth');;

Route::get('/profile/{profile}', [App\Http\Controllers\ProfileController::class, 'show'])->name('showProfile')->middleware('auth');
Route::get('/profile/{profile}/rated', [App\Http\Controllers\ProfileController::class, 'rated'])->name('showRated')->middleware('auth');
Route::get('/profile/{profile}/comments', [App\Http\Controllers\ProfileController::class, 'comments'])->name('showComments')->middleware('auth');
Route::get('/profile/{profile}/reactions', [App\Http\Controllers\ProfileController::class, 'reactions'])->name('showReactions')->middleware('auth');
Route::get('/profile/{profile}/favorite', [App\Http\Controllers\ProfileController::class, 'favorite'])->name('showFavorite')->middleware('auth');


Route::get('/profile/{profile}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('editProfile')->middleware('auth');
Route::patch('/profile/{profile}/edit', [App\Http\Controllers\ProfileController::class, 'editPatch'])->name('editProfilePatch')->middleware('auth');

Route::get('/movie/{movie}/favorite', [App\Http\Controllers\MovieController::class, 'favorite'])->name('movieFavorite');




Route::get('/person/{person}', [App\Http\Controllers\PersonController::class, 'show'])->name('showPerson');
Route::get('/person/{person}/edit', [App\Http\Controllers\PersonController::class, 'edit'])->name('editPerson');
Route::patch('/person/{person}/edit', [App\Http\Controllers\PersonController::class, 'editPatch'])->name('editPatchPerson');


Route::get('/admin/panel', [App\Http\Controllers\AdminController::class, 'index'])->name('indexAdmin')->middleware('auth', 'admin');
Route::get('/admin/{movie}/delete', [App\Http\Controllers\AdminController::class, 'delete'])->name('deleteMovie')->middleware('auth', 'admin');
Route::get('/admin/{movie}/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('editMovie')->middleware('auth', 'admin');
Route::patch('/admin/{movie}/edit', [App\Http\Controllers\AdminController::class, 'update'])->name('updateMovie')->middleware('auth', 'admin');
Route::get('/admin/approve', [App\Http\Controllers\AdminController::class, 'approve'])->name('adminApprove')->middleware('auth', 'admin');
Route::get('/admin/{movie}/approve', [App\Http\Controllers\AdminController::class, 'approveMovie'])->name('adminApproveMovie')->middleware('auth', 'admin');
Route::get('/admin/{movie}/select', [App\Http\Controllers\AdminController::class, 'addToSelected'])->name('addToSelected')->middleware('auth', 'admin');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
