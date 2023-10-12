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

        return view('pages.editUser', [
            'user' => $user,
        ]);
    }

    public function editProcess(Request $request) {
        $user = User::where('email', $request->email)->first();
        $messages = [
            'required' => ':attribute tidak boleh kosong',
        ];

        $this->validate($request, [
            'email' => 'required',
            'name' => 'required',
        ], $messages);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'isAdmin' => $request->isAdmin,
        ]);

        if ($user) {
            return redirect()->route('user')->with('success', 'Berhasil update user');
        }
        return redirect()->back()->with('error', 'Gagal update user');
    }
}
