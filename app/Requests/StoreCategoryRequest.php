<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'category_id'   => ['filled', 'integer'],
            'name'          => ['required', 'string', 'max:255'],
        ];
    }
}
