<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function store(Request $request)
    {
        $todo = $request->todo;
        $user_id = $request->user_id;

        $todoList = new Todo();
        $todoList->todo = $todo;
        $todoList->user_id = $user_id;

        $todoList->save();

        $id = $todoList->id;

        return $id;
    }
}
