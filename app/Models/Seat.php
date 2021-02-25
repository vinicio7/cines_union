<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Seat extends Model
{    
    use LaravelVueDatatableTrait;
    protected $table = 'seat';
    protected $fillable = [
        'seat_id',
        'room_id',
        'seat_number',
        'status',
    ];
    public $primaryKey  = 'seat_id';
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

    public function cinema_room()
    {
        return $this->hasOne('App\Models\CinemaRoom', 'room_id', 'room_id');
    }
    
}
