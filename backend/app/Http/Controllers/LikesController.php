<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function store(Request $request, Post $post)
    {  //타입을 지정해주면 find 하지 않아도 찾아준다
        // $post = Post::find($post);
        // return $post->likes()->toggle(auth()->user());
        // $user = $request->
        $user = User::find($request->user);
        return $post->likes()->toggle($user);
        /*toggle이란?
        로그인된 사용자의 좋아요/좋아요취소 요청처리
        */
    }
}
