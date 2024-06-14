<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'status',
    ];

    protected static function booted()
    {
        static::created(function ($announcement) {
            $announcement->slug = Str::slug($announcement->title, '-');
        });

        static::updated(function ($announcement) {
            $announcement->slug = Str::slug($announcement->title, '-');
        });
    }
}
