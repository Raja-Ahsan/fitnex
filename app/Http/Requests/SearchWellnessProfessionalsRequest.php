<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchWellnessProfessionalsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $services = $this->input('services', []);
        if (! is_array($services)) {
            $services = $services !== null && $services !== '' ? [$services] : [];
        }

        $goals = $this->input('goals', []);
        if (! is_array($goals)) {
            $goals = $goals !== null && $goals !== '' ? [$goals] : [];
        }

        $this->merge([
            'services' => array_values(array_unique(array_filter(array_map('strval', $services)))),
            'goals' => array_values(array_unique(array_filter(array_map('strval', $goals)))),
            'city' => is_string($this->city) ? trim($this->city) : $this->city,
            'state' => is_string($this->state) ? trim($this->state) : $this->state,
            'zip' => is_string($this->zip) ? trim($this->zip) : $this->zip,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $goalKeys = array_keys(config('wellness_goals.options', []));

        return [
            'services' => ['required', 'array', 'min:1'],
            'services.*' => [
                'required',
                'string',
                'max:191',
                Rule::exists('categories', 'slug')->where(fn ($q) => $q->where('status', 1)),
            ],
            'delivery' => ['required', 'in:online,in_person,both'],
            'city' => ['nullable', 'string', 'max:100', 'required_if:delivery,in_person'],
            'state' => ['nullable', 'string', 'max:100', 'required_if:delivery,in_person'],
            'zip' => ['nullable', 'string', 'max:20'],
            'radius' => ['nullable', 'integer', Rule::in([5, 10, 25, 50])],
            'goals' => ['nullable', 'array'],
            'goals.*' => ['string', Rule::in($goalKeys)],
            'page' => ['nullable', 'integer', 'min:1'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'services.required' => 'Please select at least one service.',
            'services.min' => 'Please select at least one service.',
            'services.*.exists' => 'One or more selected services are not valid.',
            'delivery.required' => 'Please choose how you would like to work with a wellness professional.',
            'delivery.in' => 'Please choose Online, In person, or Either.',
            'city.required_if' => 'Please enter your city for in-person matching.',
            'state.required_if' => 'Please enter your state for in-person matching.',
            'goals.*.in' => 'One or more selected goals are not valid.',
        ];
    }
}
