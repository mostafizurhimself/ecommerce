<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Facades\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    /**
     * Check customer availablity
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkCustomer(Request $request)
    {
        $customer = Customer::where("email", $request->email)->first();
        if ($customer) {
            return Response::success("Customer already exists", ["exists"  => true, 'data' => $customer]);
        }
        return Response::error("Customer doesn't exists", ["exists"  => false], 404);
    }
}