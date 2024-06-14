<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLending extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lending()
    {
        return $this->belongsTo(Lending::class);
    }
}
