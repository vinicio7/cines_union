<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Cinema extends Model
{    
    use LaravelVueDatatableTrait;
    protected $table = 'cinema';

    protected $fillable = [
        'cinema_id',
        'name',
        'logo',
        'adress',
        'phone',
        'latitude',
        'longitude',
        'departament_id',
        'municipality_id',
        'status',
    ];

    public $primaryKey  = 'cinema_id';
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
        'adress' => [
            'searchable' => true,
        ],
        'phone' => [
            'searchable' => true,
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

    public function departament()
    {
        return $this->hasOne('App\Models\Departament', 'departament_id', 'departament_id');
    }

    public function municipality()
    {
        return $this->hasOne('App\Models\Municipality', 'municipality_id', 'municipality_id');
    }
    
}
