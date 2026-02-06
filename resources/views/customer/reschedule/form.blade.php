@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Reschedule Booking</h4>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Current Booking Info -->
                        <div class="card bg-light mb-4">
                            <div class="card-header">
                                <h5>Current Booking Details</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Trainer:</strong> {{ $booking->trainer->name }}</p>
                                <p><strong>Current Date:</strong> {{ $booking->timeSlot->formatted_date }}</p>
                                <p><strong>Current Time:</strong> {{ $booking->timeSlot->formatted_time }}</p>
                                <p><strong>Price:</strong> ${{ number_format($booking->price, 2) }}</p>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Note:</strong> You can only reschedule bookings at least
                            {{ config('booking.reschedule_cutoff_hours', 6) }} hours before the scheduled time.
                        </div>

                        <!-- Reschedule Form -->
                        <form action="{{ route('customer.bookings.reschedule.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                            <div class="mb-3">
                                <label for="new_slot_id" class="form-label">Select New Time Slot <span
                                        class="text-danger">*</span></label>
                                <select name="new_slot_id" id="new_slot_id"
                                    class="form-select @error('new_slot_id') is-invalid @enderror" required>
                                    <option value="">Choose a new time slot</option>
                                    @foreach($availableSlots as $slot)
                                        <option value="{{ $slot->id }}">
                                            {{ $slot->slot_datetime->format('l, M d, Y') }} at {{ $slot->formatted_time }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('new_slot_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($availableSlots->isEmpty())
                                    <div class="alert alert-danger mt-2">
                                        <i class="fas fa-exclamation-circle"></i> No available slots found for rescheduling.
                                        Please contact the trainer.
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason for Rescheduling (Optional)</label>
                                <textarea name="reason" id="reason"
                                    class="form-control @error('reason') is-invalid @enderror" rows="3"
                                    placeholder="Let the trainer know why you need to reschedule..."></textarea>
                                @error('reason')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <ul class="mb-0 mt-2">
                                    <li>Your original payment will be applied to the new slot</li>
                                    <li>If the new session has a different duration, price differences will be handled
                                        accordingly</li>
                                    <li>The trainer will be notified of your reschedule request</li>
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('customer.bookings.show', $booking->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary" {{ $availableSlots->isEmpty() ? 'disabled' : '' }}>
                                    <i class="fas fa-calendar-check"></i> Confirm Reschedule
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection