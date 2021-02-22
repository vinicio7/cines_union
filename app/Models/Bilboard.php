<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bilboard extends Model
{    
   protected $table = 'bilboard';
   protected $fillable = [
        'bilboard_id',
        'room_id',
        'movie_id',
        'start_time',
        'end_time',
        'date',
        'price',
        'status',
    ];
    public $primaryKey  = 'bilboard_id';
    protected $dataTableColumns = [
        'bilboard_id' => [
            'searchable' => false,
        ],
        'room_id' => [
            'searchable' => true,
        ],
        'movie_id' => [
            'searchable' => true,
        ],
        'start_time' => [
            'searchable' => true,
        ],
        'end_time' => [
            'searchable' => true,
        ],
        'date' => [
            'searchable' => true,
        ],
        'price' => [
            'searchable' => true,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];

    public function room()
    {
        return $this->hasOne('App\Models\CinemaRoom', 'room_id', 'room_id');
    }

    public function movie()
    {
        return $this->hasOne('App\Models\Movie', 'movie_id', 'movie_id');
    }
    
}
