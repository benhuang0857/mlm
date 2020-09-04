<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'a_price', 'b_price', 'c_price', 'd_price', 'e_price', 'f_price', 'image', 'description'
    ];

    public $timestamps = true;
}
