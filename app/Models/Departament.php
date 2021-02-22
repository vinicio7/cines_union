<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{    
   protected $table = 'departament';
   protected $fillable = [
        'departament_id',
        'name',
        'status',
    ];
    public $primaryKey  = 'departament_id';
    protected $dataTableColumns = [
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
