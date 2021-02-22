<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{    
   protected $table = 'municipality';
   protected $fillable = [
        'municipality_id',
        'departament_id',
        'name',
        'status',
    ];

    protected $dataTableColumns = [
        'municipality_id' => [
            'searchable' => false,
        ],
        'departament_id' => [
            'searchable' => false,
        ],
        'name' => [
            'searchable' => true,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
    
}
