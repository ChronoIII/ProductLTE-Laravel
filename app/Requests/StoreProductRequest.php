<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'product_id'            => ['nullable'],
            'name'                  => ['required', 'string'],
            'category_id'           => ['required', 'integer'],
            'description'           => ['required', 'string'],
            'date_time'             => ['required', 'string'],
            'image_to_add'          => ['nullable', 'array'],
            'image_to_add.*'        => ['required', 'mimes:png,jpeg,jpg,gif,webp', 'image'],
            'image_to_delete'       => ['filled', 'nullable', 'array'],
            'image_to_delete.*'     => ['required', 'integer'],
        ];
    }
}
