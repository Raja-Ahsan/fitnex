<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Booking;

class RescheduleBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $booking = Booking::find($this->route('id') ?? $this->booking_id);

        if (!$booking) {
            return false;
        }

        // User must be the customer or the trainer
        return $this->user()->id === $booking->user_id ||
            $this->user()->id === $booking->trainer->created_by ||
            $this->user()->hasRole('trainer') ||
            $this->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'booking_id' => ['required', 'exists:bookings,id'],
            'new_slot_id' => ['required', 'exists:time_slots,id'],
            'reason' => ['nullable', 'string', 'max:500'],
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
            'booking_id.required' => 'Booking ID is required.',
            'booking_id.exists' => 'The booking does not exist.',
            'new_slot_id.required' => 'Please select a new time slot.',
            'new_slot_id.exists' => 'The selected time slot is not available.',
            'reason.max' => 'Reason cannot exceed 500 characters.',
        ];
    }
}
