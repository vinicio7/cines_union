<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class User extends Model
{    
    use LaravelVueDatatableTrait;
    protected $table = 'user';
    protected $fillable = [
        'user_id',
        'cinema_id',
        'type',
        'name',
        'user',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
    public $primaryKey  = 'user_id';
    protected $dataTableColumns = [
        'user_id' => [
            'searchable' => false,
        ],
        'cinema_id' => [
            'searchable' => false,
        ],
        'type' => [
            'searchable' => true,
        ],
        'name' => [
            'searchable' => true,
        ],
        'user' => [
            'searchable' => true,
        ],
        'password' => [
            'searchable' => false,
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
