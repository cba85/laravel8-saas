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

        $path = $request->img->store('images');

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'img' => $path,
            'user_id' => $request->user()->id
        ]);

        return redirect()->route('posts.index');
    }
}
