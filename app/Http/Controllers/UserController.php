<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if(auth()->user()->user_level > 1)
        {
            $users = User::where('user_level', '>', '1')->paginate();
        }
        else
        {
            $users = User::paginate();
        }

        return view('users.index', compact('users'));
    }
}
