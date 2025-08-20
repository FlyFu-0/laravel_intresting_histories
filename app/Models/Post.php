<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISHED = 'published';
    const STATUS_REJECTED = 'rejected';

    public function tags() {
        return $this->belongsToMany(Tag::class)->as('tags');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
