<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $table = 'chat_messages';

    protected $fillable = ['chat_id', 'user_id', 'message', 'read', 'message_reply_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function replyTo()
    {
        return $this->belongsTo(Message::class, 'message_reply_id');
    }
}
