<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesRecord extends Model
{
    protected $table = "sales_record";
    protected $fillable = ["product_id"];
    protected  $hidden = ['created_at', 'updated_at', 'deleted_at', 'status_id'];

}
