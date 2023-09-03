<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email'],
            'password'  => ['required', 'string', 'confirmed']
        ];
    }
}
