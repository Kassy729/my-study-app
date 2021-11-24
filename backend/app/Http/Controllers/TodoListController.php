<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function store(Request $request)
    {
        $user_id = $request->user_id;

        $todo = new Todo();
        $todo->user_id = $user_id;

        $todo->save();
    }

    public function todo(Request $request)
    {
        return 1;
    }
}
