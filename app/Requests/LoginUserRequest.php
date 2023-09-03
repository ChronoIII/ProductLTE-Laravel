<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id'        => ['required', 'string'],
            'password'  => ['required', 'string'],
            'remember'  => ['required', 'bool'],
        ];
    }
}
