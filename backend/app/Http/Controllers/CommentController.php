<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate(['comment' => ['required']]);

        $comment = Comment::create(
            [
                'comment' => $request->comment,
                'user_id' => "1",
                'post_id' => $id
            ]
        );
        return $comment;
    }

    public function index($id)
    {
        // $comments = Comment::where('post_id', $id)->with('user')->get();
        $comments = Comment::all();
        // $comments = Comment::with('user')->where('post_id', $id)->latest()->get();
        return $comments;
    }
}
