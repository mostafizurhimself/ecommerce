<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Delivery;
use App\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Requests\ValidateIdsFromRequest;

class DeliveryController extends Controller
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
            return ApiResource::collection(Delivery::with('customer')->filter($request->all())->trashed()->sorted()->paginate($request->perPage));
        }
        return ApiResource::collection(Delivery::with('customer')->filter($request->all())->trashed()->sorted()->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Delivery $delivery)
    {
        return new ApiResource($delivery->load('address', 'deliveryItems.product', 'deliveryItems.unit', 'customer')->append('billingAddress', 'shippingAddress'));
    }
}