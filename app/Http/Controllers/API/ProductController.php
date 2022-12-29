<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products,200,['Content-Type'=>'application/json;charset-UTF-8','Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $product = Product::create($input);

        return response()->json([
            "success" => true,
            "message" => "Product created",
            "data"=> $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Product::destroy($id);
        $products = Product::all();

        if($response != 0) {
            return response()->json([
                "success" => true,
                "message" => "Product deleted",
                "data" => $products
            ]);
        }
        else
        {
            return response()->json([
                "success" => false,
                "message" => "Product it not deleted",
                "data" => $products
            ]);
        }
    }
}
