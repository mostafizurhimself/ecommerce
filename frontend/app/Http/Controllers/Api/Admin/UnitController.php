<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;

class UnitController extends Controller
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
    public function __invoke(Request $request)
    {
        if ($request->has('perPage')) {
            return ApiResource::collection(Unit::filter($request->all())->orderBy('name')->paginate($request->perPage));
        }
        return ApiResource::collection(Unit::filter($request->all())->orderBy('name')->get());
    }
}