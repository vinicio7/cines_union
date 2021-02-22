<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{    
   protected $table = 'seat';
   protected $fillable = [
        'seat_id',
        'room_id',
        'seat_number',
        'status',
    ];

    protected $dataTableColumns = [
        'seat_id' => [
            'searchable' => false,
        ],
        'room_id' => [
            'searchable' => false,
        ],
        'seat_number' => [
            'searchable' => true,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
    
}
