<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentRating;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Movie $movie, Request $request){
        $comment = $request['comment'];
        $myUser = auth()->user();
        Comment::create(
            ['movie_id' => $movie->id, 'user_id' => $myUser->id, 'content' => $comment],
        );
        $myUser->points = $myUser->points + 6;
        $myUser->save();
        return redirect(route('showMovie', $movie->id));
    }
    public function edit(Movie $movie){
        $oldComment = Comment::where('movie_id', $movie->id)->where('user_id', auth()->user()->id)->first();
        return view('movies.comment', compact('movie', 'oldComment'));
    }
    public function patch(Movie $movie, Request $request){
        $commentAuth =  Comment::where('user_id', auth()->user()->id)->where('movie_id', $movie->id)->first();
        $this->authorize('update', $commentAuth);
        $comment = $request['comment'];
        Comment::where(['movie_id' => $movie->id, 'user_id' => auth()->user()->id])->update(['content' => $comment]);
        return redirect(route('showMovie', $movie->id));
    }
    public function delete(Movie $movie){
        $comment =  Comment::where('user_id', auth()->user()->id)->where('movie_id', $movie->id)->first();
        $this->authorize('delete', $comment);
        Comment::where('user_id', auth()->user()->id)->where('movie_id', $movie->id)->delete();
        return redirect(route('showMovie', $movie->id));
    }
    public function like(Request $request){
        if($request['likeOrDis']==1){
            CommentRating::updateOrCreate(
                ['comment_id' => $request['comment_id'], 'user_id' => auth()->user()->id],
                ['value' => 1]
            );
            $allComRatings = CommentRating::where('comment_id', $request['comment_id'])->get();
            $celkovyRating = 0;
            foreach ($allComRatings as $acr) {
                $celkovyRating += $acr->value;
            }
            Comment::where('id', $request['comment_id'])->update(['rating' => $celkovyRating]);
        }elseif($request['likeOrDis']==0){
            CommentRating::updateOrCreate(
                ['comment_id' => $request['comment_id'], 'user_id' => auth()->user()->id],
                ['value' => -1]
            );
            $allComRatings = CommentRating::where('comment_id', $request['comment_id'])->get();
            $celkovyRating = 0;
            foreach ($allComRatings as $acr) {
                $celkovyRating += $acr->value;
            }
            Comment::where('id', $request['comment_id'])->update(['rating' => $celkovyRating]);
        }
    }
}
