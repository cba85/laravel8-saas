<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'img' => 'required|image'
        ]);

        //$path = $request->img->store('images'); // Laravel upload (not good using Heroku)
        $result = $request->img->storeOnCloudinary();

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'img_url' => $result->getSecurePath(),
            'img_id' => $result->getPublicId(),
            'user_id' => $request->user()->id
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $result = cloudinary()->destroy($post->img_id);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
