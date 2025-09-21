<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use function Laravel\Prompts\error;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = [];
        if ($search) {
            $users = User::with('roles')->where('name', 'likes', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->get();
        }

        if ($search && count($users) < 1) {
            return redirect()->back()
                ->withErrors(['search' => __('No users found for your search.')])
                ->withInput();
        }

        return view('user.manage', ['users' => $users]);
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
