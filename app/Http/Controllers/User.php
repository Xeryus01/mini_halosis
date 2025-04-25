<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    //
    public function index(Request $request)
    {
        return auth()->user();
    }

    public function profile()
    {
        $username = auth()->user()['name'];

        return view('profile', ['navbar' => 'Profil', 'username' => auth()->user()['name']]);
    }
}
