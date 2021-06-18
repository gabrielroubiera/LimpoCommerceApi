<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesRecordResource;
use App\Product;
use App\SalesRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\Auth;

class SalesRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $salesRecords = SalesRecord::where('status_id', '=' , 1)
            ->where('user_id', '=', $user_id)
            ->whereNull('deleted_at')
            ->get();

        return response()->json($salesRecords);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|string',
            'amount' => 'required|string',
            'total_price' => 'required|string'
        ]);

        $SalesRecord = SalesRecord::insert(
            array('product' => $request->product,
                'category' => $request->category,
                'price' => $request->price,
                'amount' => $request->amount,
                'total_price' => $request->total_price,
                'user_id' => Auth::user()->id,
                'status_id' => 1
            )
        );

        $product = Product::where('id', '=', $request->products_id)->get();

        $amount = intval($product[0]->amount) - intval($request->amount);
        Product::where('id', $request->products_id)
            ->update(['amount' => $amount]);

        return response()->json($SalesRecord);
    }
}
