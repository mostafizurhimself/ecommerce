<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'categoryId'  => ['required', 'integer'],
                        'name'        => ['required', 'string', 'max:100', Rule::unique('products', 'name')],
                        'sku'         => ['required', 'string', 'max:100', Rule::unique('products', 'sku')],
                        'description' => ['nullable', 'string', 'max:500'],
                        'price'       => ['required', 'numeric', 'min:0'],
                        'quantity'    => ['required', 'numeric', 'min:0'],
                        'unitId'      => ['required', 'integer'],
                        'image'       => ['required', 'base64max:5120', 'base64mimes:png,jpg'],
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'categoryId'  => ['required', 'integer'],
                        'name'        => ['required', 'string', 'max:100', Rule::unique('products', 'name')->ignore($this->product->id)],
                        'sku'         => ['required', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($this->product->id)],
                        'description' => ['nullable', 'string', 'max:500'],
                        'price'       => ['required', 'numeric', 'min:0'],
                        'quantity'    => ['required', 'numeric', 'min:0'],
                        'unitId'      => ['required', 'integer'],
                        'image'       => ['sometimes', 'base64max:5120', 'base64mimes:png,jpg'],
                    ];
                }
            default:
                break;
        }
    }
}