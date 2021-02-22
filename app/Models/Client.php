<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{    
   protected $table = 'client';
   protected $fillable = [
        'client_id',
        'name',
        'direction',
        'tax',
        'name_tax',
        'phone',
        'status',
    ];

    protected $dataTableColumns = [
        'client_id' => [
            'searchable' => false,
        ],
        'name' => [
            'searchable' => true,
        ],
        'direction' => [
            'searchable' => true,
        ],
        'tax' => [
            'searchable' => true,
        ],
        'name_tax' => [
            'searchable' => true,
        ],
        'phone' => [
            'searchable' => true,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
    
}
