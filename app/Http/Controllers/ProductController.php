<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $products = Product::where('status_id', '=' , 1)
            ->where('amount', '!=', '0')
            ->whereNull('deleted_at')
            ->get();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return Product
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json();
    }

    public function productsNoAvailable()
    {
        $products = Product::where('status_id', '=' , 1)
            ->where('amount', '=', '0')
            ->whereNull('deleted_at')
            ->get();

        return response()->json($products);
    }

    public function searchProducts(Request $request){
        $products = Product::where('name', 'LIKE', "{$request->product_source}%")->get();
        return response()->json($products);
    }
}
