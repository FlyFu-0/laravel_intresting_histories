<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request) {
        if (!Gate::allows('can-manage-users')) {
            abort(403);
        }

        $search = $request->input('search');

        $users = [];
        if ($search) {
            $users = User::with('roles')->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->get();
        }

        return view('user.user-manage', ['users' => $users]);
    }
}
