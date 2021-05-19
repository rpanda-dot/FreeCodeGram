<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    //
    public function show(User $user)
    {
        return view('profiles.index', compact('user'));
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
