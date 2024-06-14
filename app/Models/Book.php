<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($book) {
            $book->slug = generateSlug($book->title);
        });
    }

    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_slug', 'slug');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('author', 'like', '%' . $search . '%');
    }

    public function scopeRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    // get average rating of a book
    public function getRatingAttribute()
    {
        return $this->reviews->avg('rating') ?: 0;
    }

    // check if user has reviewed a book
    public function hasReviewed($user)
    {
        return $this->reviews()->where('user_id', $user->id)->exists();
    }
}
