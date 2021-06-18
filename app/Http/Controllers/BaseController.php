<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    public function all($table){
        $products = $table::where('status_id', '=' , 1)->whereNull('deleted_at')->get();
        return response()->json($products);
    }


}
