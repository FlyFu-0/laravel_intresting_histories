<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = [];
        if ($search) {
            $users = User::with('roles')->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->get();
        }

        return view('user.user-manage', ['users' => $users]);
    }

    public function mute(Request $request, User $user)
    {
        Gate::authorize('mute', $user);

        if ($request->get('until')) {
            $user->muted_at = now();
        }
        $user->muted_until = $request->get('until') ?: now();
        $user->save();

        return redirect()->back();
    }

    public function ban(Request $request, User $user)
    {
        Gate::authorize('ban', $user);

        if ($request->get('until')) {
            $user->banned_at = now();
            $user->forceLogout();
        }
        $user->unbanned_at = $request->get('until') ?: now();
        $user->save();

        return redirect()->back();
    }
}
