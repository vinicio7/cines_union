<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{    
   protected $table = 'cinema';
   protected $fillable = [
        'cinema_id',
        'name',
        'logo',
        'latitude',
        'longitude',
        'departament_id',
        'municipality_id',
        'status',
    ];

    protected $dataTableColumns = [
        'cinema_id' => [
            'searchable' => false,
        ],
        'name' => [
            'searchable' => true,
        ],
        'logo' => [
            'searchable' => false,
        ],
        'latitude' => [
            'searchable' => false,
        ],
        'longitude' => [
            'searchable' => false,
        ],
        'departament_id' => [
            'searchable' => false,
        ],
        'municipality_id' => [
            'searchable' => false,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
    
}
