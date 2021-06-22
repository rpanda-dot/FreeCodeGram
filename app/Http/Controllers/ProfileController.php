<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show(User $user)
    {
        // $postCount = $user->posts()->count();
        $postCount = Cache::remember('count.post' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->posts->count();
        });
        $followerCount = Cache::remember('count.followers' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->profile->followers()->count();
        });





        // $followingCount = Cache::remember('count.followings' . $user->id, now()->addSeconds(30), function () use ($user) {
        $followingCount = $user->followings()->count();
        // });
        $follows = (auth()->user()) ? auth()->user()->followings->contains($user->id) : false;
        return view('profiles.index', compact('user', 'follows', 'followingCount', 'followerCount', 'postCount'));
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }
    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'profile_image' => 'image'
        ]);

        if (request('profile_image')) {
            $image_path = (request('profile_image')->store('profile', 'public'));
            $image = Image::make(public_path("storage/{$image_path}"))->fit(1000, 1000);
            $image->save();
            $profile_image = ['profile_image' => $image_path];
        }


        $user->profile()->update(array_merge($data, $profile_image ?? []));
        return redirect('/profile/' . $user->id);
    }
}
