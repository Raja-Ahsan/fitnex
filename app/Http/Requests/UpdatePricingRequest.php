<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePricingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && ($this->user()->hasRole('trainer') || $this->user()->hasRole('admin'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pricing' => ['required', 'array'],
            'pricing.*.session_duration' => ['required', 'in:30,45,60'],
            'pricing.*.price' => ['required', 'numeric', 'min:0', 'max:9999.99'],
            'pricing.*.currency' => ['sometimes', 'string', 'size:3'],
            'pricing.*.is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'pricing.required' => 'Pricing information is required.',
            'pricing.array' => 'Invalid pricing format.',
            'pricing.*.session_duration.required' => 'Session duration is required.',
            'pricing.*.session_duration.in' => 'Session duration must be 30, 45, or 60 minutes.',
            'pricing.*.price.required' => 'Price is required.',
            'pricing.*.price.numeric' => 'Price must be a number.',
            'pricing.*.price.min' => 'Price cannot be negative.',
            'pricing.*.price.max' => 'Price cannot exceed 9999.99.',
            'pricing.*.currency.size' => 'Currency code must be 3 characters (e.g., USD).',
        ];
    }
}
