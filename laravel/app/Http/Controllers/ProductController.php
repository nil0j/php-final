<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 *     @OA\Get(
 *         path="/api/products",
 *         summary="Get products",
 *         tags={"Products"},
 *         security={{"bearerAuth":{}}},
 *         @OA\Response(response="200", description="Success"),
 *         @OA\Response(response="500", description="Server error"),
 *     ),
 *     @OA\Get(
 *         path="/api/products/{id}",
 *         summary="Get single product",
 *         tags={"Products"},
 *         security={{"bearerAuth":{}}},
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="Product id",
 *             required=true,
 *             @OA\Schema(type="integer"),
 *         ),
 *         @OA\Response(response="200", description="Success"),
 *         @OA\Response(response="500", description="Server error"),
 *     ),
 *     @OA\Post(
 *         path="/api/products",
 *         summary="Add product",
 *         tags={"Products"},
 *         security={{"bearerAuth":{}}},
 *         @OA\RequestBody(
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 @OA\Schema(
 *                      type="object",
 *                      @OA\Property(property="name", type="string"),
 *                      @OA\Property(property="description", type="string"),
 *                      @OA\Property(property="price", type="float"),
 *                 ),
 *             ),
 *         ),
 *         @OA\Response(response="201", description="Success"),
 *         @OA\Response(response="401", description="Unauthenticated"),
 *         @OA\Response(response="500", description="Server error (or unauthenticated, if using Curl)"),
 *     ),
 *     @OA\Put(
 *         path="/api/products/{id}",
 *         summary="Modify product",
 *         tags={"Products"},
 *         security={{"bearerAuth":{}}},
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="Product id",
 *             required=true,
 *             @OA\Schema(type="integer"),
 *         ),
 *         @OA\RequestBody(
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 @OA\Schema(
 *                      type="object",
 *                      @OA\Property(property="name", type="string"),
 *                      @OA\Property(property="description", type="string"),
 *                      @OA\Property(property="price", type="float"),
 *                 ),
 *             ),
 *         ),
 *         @OA\Response(response="201", description="Success"),
 *         @OA\Response(response="401", description="Unauthenticated / not admin"),
 *         @OA\Response(response="500", description="Server error (or unauthenticated / not admin, if using Curl)"),
 *     ),
 *     @OA\Delete(
 *         path="/api/products/{id}",
 *         summary="Delete product",
 *         tags={"Products"},
 *         security={{"bearerAuth":{}}},
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="Product id",
 *             required=true,
 *             @OA\Schema(type="integer"),
 *         ),
 *         @OA\Response(response="204", description="Success"),
 *         @OA\Response(response="401", description="Unauthenticated / not admin"),
 *         @OA\Response(response="500", description="Server error (or unauthenticated / not admin, if using Curl)"),
 *     ),
 */
class ProductController extends Controller
{
    public function index()
    {
        $items = Product::all();
        return response()->json($items);
    }

    public function show($id)
    {
        $item = Product::find($id);
        return response()->json($item);
    }

    public function store(Request $request)
    {
        $item = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price') ?? 0,
        ]);
        // $item = Product::create($request->all());
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = Product::find($id);
        $item->update($request->all());
        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(null, 204);
    }
}
