<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Profile $profile){
        return view('profile.show', compact('profile'));
    }
    public function rated(Profile $profile){
        return view('profile.ratings', compact('profile'));
    }
    public function comments(Profile $profile){
        return view('profile.comments', compact('profile'));
    }
    public function reactions(Profile $profile){
        return view('profile.reactions', compact('profile'));
    }
    public function edit(Profile $profile){
        $this->authorize('update', $profile);
        return view('profile.edit', compact('profile'));
    }
    public function editPatch(Profile $profile, Request $request){
        $this->authorize('update', $profile);
        Profile::updateOrCreate(
            ['id' => $profile->id],
            ['bio' => $request['bio']]
        );
        return redirect(route('showProfile', $profile->id));
    }
}
