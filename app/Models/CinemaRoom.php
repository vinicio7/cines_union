<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class CinemaRoom extends Model
{    
    use LaravelVueDatatableTrait;
    protected $table = 'cinema_room';
    protected $fillable = [
        'room_id',
        'cinema_id',
        'seat',
        'name_room',
        'status',
    ];
    
    public $primaryKey  = 'room_id';
    
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
    
    public function cinema()
    {
        return $this->hasOne('App\Models\Cinema', 'cinema_id', 'cinema_id');
    }

    
}
