<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatInvoice extends Model
{    
   protected $table = 'seat_invoice';
   protected $fillable = [
        'seat_invoice_id',
        'client_id',
        'seat_id',
        'invoice_id',
        'bilboard_id',
    ];
    public $primaryKey  = 'seat_invoice_id';
    protected $dataTableColumns = [
        'seat_invoice_id' => [
            'searchable' => false,
        ],
        'client_id' => [
            'searchable' => false,
        ],
        'seat_id' => [
            'searchable' => false,
        ],
        'invoice_id' => [
            'searchable' => false,
        ],
        'bilboard_id' => [
            'searchable' => false,
        ],
    ];
    
}
