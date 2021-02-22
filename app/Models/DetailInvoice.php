<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailInvoice extends Model
{    
   protected $table = 'detail_invoice';
   protected $fillable = [
        'detail_id',
        'invoice_id',
        'quantity_seat',
        'price_seat',
        'subtotal',
        'status',
    ];
    public $primaryKey  = 'detail_id';
    protected $dataTableColumns = [
        'detail_id' => [
            'searchable' => false,
        ],
        'invoice_id' => [
            'searchable' => false,
        ],
        'quantity_seat' => [
            'searchable' => true,
        ],
        'price_seat' => [
            'searchable' => true,
        ],
        'subtotal' => [
            'searchable' => true,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
    
}
