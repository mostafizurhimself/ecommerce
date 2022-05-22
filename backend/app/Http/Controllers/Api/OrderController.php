<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Facades\Helper;
use App\Facades\Response;
use App\Models\OrderItem;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use App\Library\OrderHandler;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Admin\OrderCancelNotification;

class OrderController extends Controller
{

    /**
     * Set the middlewares
     */
    public function __construct()
    {
        $this->middleware('assign.guard:customers')->except('store');
        $this->middleware('jwt.auth')->except('store');
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
            return ApiResource::collection(Order::with('customer')->filter($request->all())->customer()->trashed()->sorted()->paginate($request->perPage));
        }
        return ApiResource::collection(Order::with('customer')->filter($request->all())->customer()->trashed()->sorted()->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        if (auth()->user()->id == $order->customerId) {
            return new ApiResource($order->load('address', 'orderItems.product', 'orderItems.unit', 'customer', 'orderLogs')->append('billingAddress', 'shippingAddress'));
        } else {
            Response::error('Unauthorized', 401);
        }
    }

    /**
     * Create a new order
     *
     * @param \App\Http\Requests\OrderRequest $request
     * @param \App\Library\OrderHandler       $orderHandler
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderRequest $request, OrderHandler $orderHandler)
    {
        $order = DB::transaction(function () use ($request, $orderHandler) {
            $order = $orderHandler->createOrder($request);
            return $order;
        });


        return new ApiResource($order);
    }

    /**
     * Update the order
     *
     * @param \App\Http\Requests\OrderRequest $request
     * @param \App\Models\Order               $order
     * @param \App\Library\OrderHandler       $orderHandler
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderRequest $request, Order $order, OrderHandler $orderHandler)
    {
        if ($order->status != OrderStatus::PENDING()) {
            return Response::unauthorized('Sorry, you can not update it now.', 403);
        }
        DB::transaction(function () use ($request, $orderHandler, $order) {
            $orderHandler->updateOrder($order, $request);
        });

        return new ApiResource($order->load('address', 'orderItems.product', 'orderItems.unit', 'customer')->append('billingAddress', 'shippingAddress'));
    }

    /**
     * Update order status
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Request $request, Order $order)
    {
        $this->validate($request, [
            'reason' => ['required'],
        ]);
        $order->update(['note' => $request->reason, 'status' => OrderStatus::CANCELED()]);

        // Notify the admin users
        $users = User::all();
        Notification::send($users, new OrderCancelNotification($order));

        return Response::success('Order canceled successfully.', ['order' => $order->load('address', 'orderItems.product', 'orderItems.unit', 'customer')->append('billingAddress', 'shippingAddress')]);
    }
}