<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization logic as needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'email'],
            'payment_method' => ['required', 'string'],
            'terms' => ['required', 'accepted'],
        ];

        if (Auth::check()) {
            // Rules for authenticated users
            $rules['selected_address'] = ['nullable', 'exists:addresses,id'];

            if (!$this->input('selected_address')) {
                // If no existing address is selected, require new address fields
                $rules = array_merge($rules, [
                    'name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                    'city' => ['required', 'string', 'max:255'],
                    'state' => ['required', 'string', 'max:255'],
                    'zip_code' => ['required', 'string', 'max:255'],
                    'phone' => ['required', 'string', 'max:255'],
                ]);
            }
        } else {
            // Rules for guest users
            $rules = array_merge($rules, [
                'name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'zip_code' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
            ]);
        }

        return $rules;
    }
}