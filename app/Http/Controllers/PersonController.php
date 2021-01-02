<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use App\Models\Person;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class PersonController extends Controller
{
    // PersonController - directors, actors etc..
    public function show(\App\Models\Person $person)
    {
        $casts = DB::table('casts')->where('person', $person->id)->pluck('movie');
        $movies = DB::table('movies')->whereIn('id', $casts)->where('validate', 1)->get();
        if (count($movies) == 0) {
            abort(404);
        }
        return view('person.showPerson', compact('person', 'movies'));
    }

    public function edit(Person $person)
    {
        return view('person.edit', compact('person'));
    }

    public function editPatch(Person $person, Request $request)
    {

        $this->validate($request, [
            'bio' => ['nullable', 'string'],
            'birth' => ['nullable', 'date'],
            'birth_place' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
        ]);
        if (request('image')) {
            // returns Intervention\Image\Image
            $resize = Image::make($request['image'])->fit(300)->encode('jpg');
            $hash = md5($resize->__toString());
            $path = "images/{$hash}.jpg";
            $resize->save(public_path($path));

            Person::updateOrCreate(
                ['id' => $person->id],
                ['bio' => $request['bio'], 'birth' => $request['birth'], 'birth_place' => $request['birth_place'], 'image' => $path, 'verified' => 1]
            );

            return redirect(route('showPerson', $person->id));
        } else {
            Person::updateOrCreate(
                ['id' => $person->id],
                ['bio' => $request['bio'], 'birth' => $request['birth'], 'birth_place' => $request['birth_place'], 'verified' => 1]
            );
            return redirect(route('showPerson', $person->id));
        }
    }
}
