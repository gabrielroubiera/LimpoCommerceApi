<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'amount',
        'url_foto'
    ];

    protected  $hidden = ['created_at', 'updated_at', 'deleted_at', 'status_id'];
}
