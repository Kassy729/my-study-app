<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $category = $request->tag;
        $title = $request->title;
        $content = $request->content;

        $post = new Post();
        $post->category = $category;
        $post->title = $title;
        $post->content = $content;
        $post->user_id = "1";

        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $fileName);
            $post->image = $fileName;
        }

        $post->save();
    }

    public function index()
    {
        $posts = Post::all();
        $posts = Post::orderby('created_at', 'desc')->get();
        return $posts;
    }

    public function show($id)
    {
        $post = Post::find($id);
        return $post;
    }
}
