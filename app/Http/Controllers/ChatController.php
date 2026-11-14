<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function viewAny(Request $request)
    {
        $this->authorize('viewAny', Chat::class);

        $chats = $request->user()
            ->chats()
            ->with(['latestMessage', 'users'])
            ->latest('chats.updated_at')
            ->get();

        return view('chat.viewAny', ['chats' => $chats]);
    }

    public function view(Chat $chat)
    {
        $this->authorize('view', $chat);

        $chat->load(['messages.user', 'users']);

        return view('chat.view', ['chat' => $chat]);
    }

    public function create(Request $request)
    {
        $this->authorize('create', Chat::class);

        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id', 'not_in:'.$request->user()->id],
        ]);

        $otherUser = User::findOrFail($validated['user_id']);

        $chat = Chat::query()
            ->where('type', 'private')
            ->whereHas('users', fn ($q) => $q->where('users.id', $request->user()->id))
            ->whereHas('users', fn ($q) => $q->where('users.id', $otherUser->id))
            ->first();

        if (! $chat) {
            $chat = new Chat();
            $chat->name = $otherUser->name;
            $chat->type = 'private';
            $chat->created_by = $request->user()->id;
            $chat->save();
            $chat->users()->attach([$request->user()->id, $otherUser->id]);
        }

        return redirect()->route('chats.view', $chat);
    }
}
