<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Order;
use App\Facades\Response;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class OrderController extends Controller
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
            return ApiResource::collection(Order::with('customer')->filter($request->all())->trashed()->sorted()->paginate($request->perPage));
        }
        return ApiResource::collection(Order::with('customer')->filter($request->all())->trashed()->sorted()->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        return new ApiResource($order->load('address', 'orderItems.product', 'orderItems.unit', 'customer', 'orderLogs')->append('billingAddress', 'shippingAddress'));
    }

    /**
     * Update order status
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'ids'    => 'array'
        ]);
        $updated = 0;
        foreach ($request->ids as $id) {
            $order = Order::find($id);
            if ($order->status != OrderStatus::DELIVERED()) {
                $order->update(['status' => $request->status]);
                $updated++;
            }
        }
        if ($updated) {
            return Response::success("{$updated} order updated successfully");
        }
        return Response::error('Sorry, no order updated', [], 422);
    }

    /**
     * Mark orders as delivered
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsDelivered(Request $request)
    {
        $this->validate($request, ['ids' => 'required',]);
        $updated = 0;
        foreach ($request->ids as $id) {
            $order = Order::find($id);
            if ($order->status != OrderStatus::DELIVERED()) {
                $order->updateProductsQuantity();
                $order->update(['status' => OrderStatus::DELIVERED()]);
                $updated++;
            }
        }

        if ($updated) {
            return Response::success("{$updated} order updated successfully");
        }
        return Response::error('Sorry, no order updated', [], 422);
    }
}