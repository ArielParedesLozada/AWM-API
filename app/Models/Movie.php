<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'year',
        'director',
        'duration',
        'poster',
        'genre',
        'rate'
    ];
    protected $casts = [
        'genre' => 'array',
        'year' => 'integer',
        'duration' => 'integer',
        'rate' => 'decimal:1'
    ];
}
