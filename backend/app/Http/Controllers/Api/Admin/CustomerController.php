<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Customer;
use App\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ValidateIdsFromRequest;

class CustomerController extends Controller
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
            return ApiResource::collection(Customer::filter($request->all())->trashed()->sorted()->paginate($request->perPage));
        }
        return ApiResource::collection(Customer::filter($request->all())->trashed()->sorted()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomerRequest $request)
    {
        $customer = DB::transaction(function () use ($request) {
            $customer = Customer::create($request->validated());
            if ($request->image) {
                $customer->addMediaFromBase64($request->image)->toMediaCollection('profile-photo');
            }
            return $customer;
        });
        return Response::success("Created successfully", $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Customer $customer)
    {
        return new ApiResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        DB::transaction(function () use ($request, $customer) {
            $customer->update(array_merge(
                $request->only('name', 'email', 'phone'),
                ['password' => $request->password ? bcrypt($request->password) : $customer->password]
            ));
            if ($request->image) {
                $customer->addMediaFromBase64($request->image)->toMediaCollection('profile-photo');
            }
        });
        return Response::success("Updated successfully", $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Customer $customer)
    {
        if ($customer->delete()) {
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
        $customer = Customer::withTrashed()->findOrFail($id);
        $customer->restore();
        return new ApiResource($customer);
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDelete($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);
        if ($customer->forceDelete()) {
            return Response::success("Force deleted successfully");
        };
    }
}