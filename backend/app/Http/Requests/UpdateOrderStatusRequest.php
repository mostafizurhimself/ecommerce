<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ids'    => ['required', 'array'],
            'status' => ['required', Rule::in(OrderStatus::toArray())]
        ];
    }
}