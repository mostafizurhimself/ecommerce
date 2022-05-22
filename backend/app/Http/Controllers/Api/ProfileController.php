<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Facades\Response;
use App\Enums\AddressType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerUpdateAddressRequest;
use App\Http\Requests\CustomerUpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Get the authenticated customer profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $customer = Customer::find(auth()->user()->id);
        return new ApiResource($customer->load('address')->append('billingAddress', 'shippingAddress'));
    }

    /**
     * Update authenticated customer profile.
     *
     * @param \App\Http\Requests\CustomerUpdateProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(CustomerUpdateProfileRequest $request)
    {
        DB::transaction(function () use ($request) {
            auth()->user()->update(array_merge(
                $request->only('firstName', 'lastName', 'email', 'phone')
            ));

            if ($request->photo) {
                auth()->user()->addMediaFromBase64($request->photo)->toMediaCollection('profile-photo');
            }
        });
        return new ApiResource(auth()->user()->load('address')->append('billingAddress', 'shippingAddress'));
    }

    /**
     * Update authenticated customer address.
     *
     * @param \App\Http\Requests\CustomerUpdateAddressRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAddress(CustomerUpdateAddressRequest $request)
    {
        DB::transaction(function () use ($request) {
            $customer = Customer::find(auth()->user()->id);
            // Set billing address
            if ($request->billingAddress) {
                $customer->setAddress($request->billingAddress, AddressType::BILLING_ADDRESS());
            }

            // Set shipping address
            if ($request->shippingAddress) {
                $customer->setAddress($request->shippingAddress, AddressType::SHIPPING_ADDRESS());
            }
        });
        return new ApiResource(auth()->user()->load('address')->append('billingAddress', 'shippingAddress'));
    }


    /**
     * Reset password for auth user
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required|string|min:6',
            'password'    => 'required|string|confirmed|min:6',
        ]);
        if (Hash::check($request->oldPassword, auth()->user()->password)) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            return Response::success("Password updated successfully.");
        }
        return Response::error("Old password doesn't matched.");
    }
}