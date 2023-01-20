<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
        * @OA\Get(
        *     path="/api/products",
        *     tags={"Products"},
        *     @OA\Parameter(
        *       name="name",
        *       in="query",
        *       required=true,
        *       description="To find specific product",
        *       @OA\Schema(type="string")
        *),
        *     @OA\Response(response="200", description="The data")
        * )
        */
    public function index(Request $request)
    {
        $input = $request->all();
        $name = $input['name'] ?? "";
        if(!empty($name))
        {
            $products = Product::where("name","LIKE","%$name%")->paginate(15);
            return response()->json($products,200,['Content-Type'=>'application/json;charset-UTF-8','Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);
        }

        $products = Product::paginate(15);
        return response()->json($products,200,['Content-Type'=>'application/json;charset-UTF-8','Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        /**
        * @OA\Post(
        *     path="/api/create-product",
        *     tags={"Products"},
        *     @OA\RequestBody(
        *         @OA\MediaType(
        *              mediaType="multipart/form-data",
        *              @OA\Schema(
        *               @OA\Property(
        *                   property="name",
        *                   type="string"),
        *               @OA\Property(
        *                   property="detail",
        *                   type="string")
        *       )
        *     )
        *       ),
        *     @OA\Response(response="200", description="The data")
        * )
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


      /**
      * @OA\Delete(
      *     path="/api/delete-product/{id}",
      *     tags={"Products"},
      *       @OA\RequestBody(
      *         @OA\MediaType(
      *              mediaType="json",
      *              @OA\Schema(
      *               @OA\Property(
      *                   property="id",
      *                   type="string"),
      *       )
      *     )
      *       ),
      *     @OA\Response(response="200", description="The data")
      * )
      */

    public function destroy($id)
    {
        $response = Product::destroy($id);
        $products = Product::all();

        if($response != 0) {
            return response()->json([
                "success" => true,
                "message" => "Product was deleted",
                "data" => $products
            ]);
        }
        else
        {
            return response()->json([
                "success" => false,
                "message" => "Product is not deleted",
                "data" => $products
            ]);
        }
    }
}
