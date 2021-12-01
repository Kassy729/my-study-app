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

        $post = new Post();
        $post->category = $category;
        $post->title = $title;
        $post->content = $content;
        $post->user_id = $user_id;

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

        // return $request;

        if ($request->image) {
            // 이 이미지를 이 게시글의 이미지로 파일 시스템에
            // 저장하고, DB에 반영하기 전에
            // 그 이미지를 파일 시스템에서 삭제해줘야 한다.
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
