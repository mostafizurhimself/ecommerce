<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Product;
use App\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Register the middlewares
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('assign.guard:users');
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('perPage')) {
            return ApiResource::collection(Product::with('category', 'unit')->filter($request->all())->trashed()->sorted()->paginate($request->perPage));
        }
        return ApiResource::collection(Product::filter($request->all())->trashed()->sorted()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $product = DB::transaction(function () use ($request) {
            $product = Product::create($request->validated());
            if ($request->image) {
                $product->addMediaFromBase64($request->image)->toMediaCollection('product-photo');
            }
            return $product;
        });
        return Response::success("Created successfully", $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return new ApiResource($product->load('category', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        DB::transaction(function () use ($request, $product) {
            $product->update($request->validated());
            if ($request->image) {
                $product->addMediaFromBase64($request->image)->toMediaCollection('product-photo');
            }
        });
        return Response::success("Updated successfully", $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return Response::success("Deleted successfully");
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return new ApiResource($product);
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        if ($product->forceDelete()) {
            return Response::success("Force deleted successfully");
        };
    }
}