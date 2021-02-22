<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CinemaRoom extends Model
{    
   protected $table = 'cinema_room';
   protected $fillable = [
        'room_id',
        'cinema_id',
        'seat',
        'name_room',
        'status',
    ];

    protected $dataTableColumns = [
        'room_id' => [
            'searchable' => false,
        ],
        'cinema_id' => [
            'searchable' => false,
        ],
        'seat' => [
            'searchable' => true,
        ],
        'name_room' => [
            'searchable' => true,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
    
}