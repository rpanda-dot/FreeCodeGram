<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = auth()->user()->followings()->pluck('profiles.user_id');
        // dd($users);
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(6);
        // dd($posts->links());
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);
        $image_path = (request('image')->store('uploads', 'public'));
        $image = Image::make(public_path("storage/{$image_path}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $image_path
        ]);
        return redirect('/profile/' . auth()->user()->id);
    }
    public function show(\App\Models\Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
