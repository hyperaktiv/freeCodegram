<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image as Image;

class ProfilesController extends Controller
{
    //

    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
                        'count.posts' . $user->id,
                        now()->addSeconds(30),
                        function() use ($user) {
                            return $user->posts->count();
                        });

        $followingCount = Cache::remember(
            'count.following' . $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->following->count();
            });;
            
        $followerCount = Cache::remember(
            'count.follower' . $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->profile->followers->count();
            });;

        return view('profiles.index', [
            'user' => $user,
            'follows' => $follows,
            'postCount' => $postCount,
            'followingCount' => $followingCount,
            'followerCount' => $followerCount
        ]);
    }

    public function edit(User $user)
    {
        // from ProfilePolicy
        $this->authorize('update', $user->profile);

        return view('profiles.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => 'mimes:jpg,png,jpeg|max:5048'
        ]);

        if (request('image')) {
            $newImageName = time() . '-profile-' . $user->name . '.' . request('image')->extension();
            $imagePath = request('image')->storeAs('uploads', $newImageName, 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        // merge array if exist the request('image') and update data to database
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        
        return redirect("/profile/{$user->id}");
    }
}
