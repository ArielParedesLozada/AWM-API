<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Movie extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
