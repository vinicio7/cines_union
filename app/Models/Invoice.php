<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{    
   protected $table = 'invoice';
   protected $fillable = [
        'invoice_id',
        'client_id',
        'bilboard_id',
        'user_id',
        'date',
        'total',
        'status',
    ];
    public $primaryKey  = 'invoice_id';
    protected $dataTableColumns = [
        'invoice_id' => [
            'searchable' => false,
        ],
        'client_id' => [
            'searchable' => false,
        ],
        'bilboard_id' => [
            'searchable' => false,
        ],
        'user_id' => [
            'searchable' => false,
        ],
        'date' => [
            'searchable' => true,
        ],
        'total' => [
            'searchable' => true,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
    
}
