<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{    
   protected $table = 'user';
   protected $fillable = [
        'user_id',
        'cinema_id',
        'type',
        'name',
        'user',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dataTableColumns = [
        'user_id' => [
            'searchable' => false,
        ],
        'cinema_id' => [
            'searchable' => false,
        ],
        'type' => [
            'searchable' => true,
        ],
        'name' => [
            'searchable' => true,
        ],
        'user' => [
            'searchable' => true,
        ],
        'password' => [
            'searchable' => false,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
    
}