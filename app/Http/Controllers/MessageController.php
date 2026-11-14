<?php

namespace App\Http\Controllers;

use App\Events\GotMessage;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function create(Request $request, Chat $chat)
    {
        $this->authorize('message', $chat);

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $message = new Message();
        $message->message = $validated['message'];
        $message->chat()->associate($chat);
        $message->user()->associate($request->user());
        $message->save();
        $message->load('user');

        $chat->touch();

        broadcast(new GotMessage($message))->toOthers();

        $payload = [
            'id' => $message->id,
            'chat_id' => $message->chat_id,
            'user_id' => $message->user_id,
            'user_name' => $message->user->name,
            'message' => $message->message,
            'created_at' => $message->created_at->format('H:i'),
            'is_own' => true,
        ];

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $payload,
            ]);
        }

        return redirect()->back();
    }
}
