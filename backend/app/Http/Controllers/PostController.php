<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function mainIndex()
    {
        $posts = Post::all();
        $posts = Post::orderby('created_at', 'desc')->limit(6)->paginate(6);
        return $posts;
    }

    public function store(Request $request)
    {
        $category = $request->tag;
        $title = $request->title;
        $content = $request->content;
        $user_id = $request->user_id;
        $type = $request->type;

        $post = new Post();
        $post->category = $category;
        $post->title = $title;
        $post->content = $content;
        $post->user_id = $user_id;
        $post->type = $type;

        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $fileName);
            $post->image = $fileName;
        }

        $post->save();
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $tag = $request->tag;
        $type = $request->type;

        if ($keyword || $tag) {
            if ($keyword && $tag) {
                if ($tag == 'All') {
                    $posts = Post::where('title', 'like', '%' . $keyword . '%')->paginate(6);
                    return $posts;
                }
                $posts = Post::where('title', 'like', '%' . $keyword . '%')->where('category', '=', $tag)->paginate(6);
                return $posts;
            } else if ($tag) {
                if ($tag == 'All') {
                    $posts = Post::all();
                    $posts = Post::orderby('created_at', 'desc')->paginate(6);
                    return $posts;
                }
                $posts = Post::where('category', '=', $tag)->paginate(6);
                return $posts;
            } else {
                $posts = Post::where('title', 'like', '%' . $keyword . '%')->paginate(6);
                return $posts;
            }
        } else {
            $posts = Post::all();
            $posts = Post::orderby('created_at', 'desc')->latest()->paginate(6);
            return $posts;
        }
    }

    public function show($id)
    {
        $post = Post::with(['user', 'likes'])->find($id);
        return $post;
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'content' => 'required|min:3'
            ]
        );

        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->type = $request->type;

        // return $request;

        if ($request->image) {
            // ??? ???????????? ??? ???????????? ???????????? ?????? ????????????
            // ????????????, DB??? ???????????? ??????
            // ??? ???????????? ?????? ??????????????? ??????????????? ??????.
            if ($post->image) {
                Storage::delete('public/images/' . $post->image);
            }
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $post->image = $fileName;
            $request->image->storeAs('public/images/', $fileName);
        }
        $post->save();

        return $request;
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::delete('public/images/' . $post->image);
        }

        $post->delete();
    }
}
