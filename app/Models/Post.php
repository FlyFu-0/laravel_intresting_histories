<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                $carbonDate = Carbon::parse($value)->locale(App::getLocale());
                return $carbonDate->translatedFormat($this->getDatetimeFormat($carbonDate));
            },
        );
    }

    protected function getDatetimeFormat(Carbon $date): string
    {
        $dateFormat = 'd F';
        $timeFormat = 'H:i';

        if ($date->year !== Carbon::now()->year) {
            $dateFormat .= ' Y';
        }

        return $dateFormat . ' ' . $timeFormat;
    }
}
