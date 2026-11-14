<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes;

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_chat')
            ->withTimestamps()
            ->withPivot('deleted_at');
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }
}
