<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        request()->merge(['phone' => str_replace(' ', '', request()->phone)]);

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|regex:/^([a-z0-9+-]+)(.[a-z0-9+-]+)*@([a-z0-9-]+.)+[a-z]{2,6}$/ix',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => __('The customer phone number format is invalid. It should start with a "+" followed by digits.'),
        ];
    }
}
