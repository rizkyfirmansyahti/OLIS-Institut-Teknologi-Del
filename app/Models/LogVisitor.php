<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogVisitor extends Model
{
    use HasFactory;

    protected $table = 'log_visitors';
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'visited_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
