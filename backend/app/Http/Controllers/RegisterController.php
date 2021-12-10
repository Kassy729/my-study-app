<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required'],
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);


        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $fileName);
            $user->image = $fileName;
        }


        $user->save();
        return response($user, 202);
    }

    public function profile(Request $request)
    {
        $id = $request->userId;
        $user = User::find($id);

        return $user;
    }


    public function user(Request $request)
    {
        $id = $request->userId;
        $user = User::find($id);
        return $user;
    }

    public function edit(Request $request)
    {
        $userId = $request->userId;
        $user = User::find($userId);

        if ($request->image) {
            if ($user->image) {
                Storage::delete('public/images/' . $user->image);
            }
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $user->image = $fileName;
            $request->image->storeAs('public/images/', $fileName);
        }

        $user->save();

        return $request;
    }
}
