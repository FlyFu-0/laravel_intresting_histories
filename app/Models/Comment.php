<?php

namespace App\Models;

use App\Models\Base\PivotBase;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Comment extends PivotBase
{
    protected $table = 'comments';

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                $carbonDate = Carbon::parse($value);
                return $carbonDate->translatedFormat($this->getDatetimeFormat($carbonDate));
            },
        );
    }
}
