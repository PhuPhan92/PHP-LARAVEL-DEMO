<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productivity extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'style',
        'po',
        'product_output',
        'employee_quantity',
        'manufacture_date',
    ];

        protected $casts = [
        'manufacture_date' => 'datetime:Y-m-d',
        'employee_quantity' => 'float',
    ];
}
