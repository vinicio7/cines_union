<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{    
   protected $table = 'movie';
   protected $fillable = [
        'movie_id',
        'title',
        'duration',
        'gender',
        'rating',
        'format',
        'image',
        'language',
        'status',
    ];

    protected $dataTableColumns = [
        'movie_id' => [
            'searchable' => false,
        ],
        'title' => [
            'searchable' => true,
        ],
        'duration' => [
            'searchable' => true,
        ],
        'gender' => [
            'searchable' => false,
        ],
        'rating' => [
            'searchable' => false,
        ],
        'format' => [
            'searchable' => false,
        ],
        'image' => [
            'searchable' => false,
        ],
        'language' => [
            'searchable' => true,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
    
}
