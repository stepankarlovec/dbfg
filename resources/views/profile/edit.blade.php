@extends('profile.userMenu')
@section('things')
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            @auth
                <div class="row">
                    <div class="col-md-6">
                        <h1>Upravit BIO - (text o mně):</h1>
                        <form method="post" action="{{ route('editProfilePatch', $profile->id) }}">
                            @method('PATCH')
                            @csrf
                            <textarea name="bio" class="form-control" placeholder="Napište něco o sobě.." rows="3">{{ $profile->bio }}</textarea>
                            <input type="submit" class="btn btn-success mt-1">
                        </form>
                    </div>
                </div>
            @endauth
        </div>
        </div>
    </div>
@endsection
