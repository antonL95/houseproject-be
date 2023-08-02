<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'street' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'postcode' => ['required'],
            'client_user_id' => ['required', 'integer'],
            'description' => ['nullable'],
            'menu' => ['nullable'],
            'offering' => ['nullable'],
            'product_limit' => ['required', 'integer'],
            'condition' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
