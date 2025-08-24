<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');

        $users = [];
        if ($search) {
            $users = User::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->get();
        }

        dump($users->first()->session()->lastActivity);

        return view('user.user-manage', ['users' => $users]);
    }
}
