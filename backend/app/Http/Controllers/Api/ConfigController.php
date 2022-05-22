<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Facades\ConfigHelper;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    /**
     * Get the appearances and settings
     */
    public function __invoke()
    {
        $data = [
            'countries'       => Country::all(),
            'categories'      => Category::all(),
            'enums'           => ConfigHelper::getEnums(),
            'options'         => ConfigHelper::getOptions(),
            'featureProducts' => Product::with('unit', 'category')->withCount('orderItems')->orderBy('order_items_count', 'desc')->take(8)->get(),
            'orderStatus'     => OrderStatus::toSelectOptions([OrderStatus::DELIVERED()])
        ];

        return new ApiResource($data);
    }
}