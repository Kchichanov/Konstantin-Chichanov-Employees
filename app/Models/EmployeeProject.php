<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProject extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];

}
