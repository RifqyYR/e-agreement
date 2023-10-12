<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view(
            'pages.user',
            [
                'users' => $users,
            ],
        );
    }

    public function edit(String $id)
    {
        $user = User::find($id);

        dd($user);
        if (!$user) {
            abort(404);
        }
    }
}
