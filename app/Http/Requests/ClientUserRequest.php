<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254'],
            'first_name' => ['nullable'],
            'last_name' => ['nullable'],
            'var_number' => ['nullable'],
            'street' => ['nullable'],
            'city' => ['nullable'],
            'country' => ['nullable'],
            'postcode' => ['nullable'],
            'email_verified_at' => ['nullable', 'date'],
            'password' => ['nullable'],
            'google_id' => ['nullable'],
            'facebook_id' => ['nullable'],
            'apple_id' => ['nullable'],
            'profile_image' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
