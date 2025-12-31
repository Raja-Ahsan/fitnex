@extends('layouts.app')

@section('title', 'Payment Cancelled')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-warning">
                    <div class="card-header bg-warning text-white text-center">
                        <h3><i class="fas fa-exclamation-triangle"></i> Payment Cancelled</h3>
                    </div>
                    <div class="card-body text-center py-5">
                        <i class="fas fa-times-circle text-warning" style="font-size: 80px;"></i>

                        <h4 class="mt-4">Your payment was cancelled</h4>
                        <p class="text-muted">You have cancelled the payment process. Your booking has not been confirmed.
                        </p>

                        @if(isset($booking))
                            <div class="card mt-4 mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Booking Information</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 text-start">
                                            <p><strong>Trainer:</strong></p>
                                            <p><strong>Date:</strong></p>
                                            <p><strong>Time:</strong></p>
                                            <p><strong>Price:</strong></p>
                                        </div>
                                        <div class="col-md-6 text-start">
                                            <p>{{ $booking->trainer->name }}</p>
                                            <p>{{ $booking->timeSlot->formatted_date }}</p>
                                            <p>{{ $booking->timeSlot->formatted_time }}</p>
                                            <p>${{ number_format($booking->price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                The time slot is still reserved for you. You can complete the payment later or choose a
                                different slot.
                            </div>
                        @endif

                        <div class="mt-4">
                            @if(isset($booking))
                                <a href="{{ route('customer.bookings.create', ['slot_id' => $booking->time_slot_id]) }}"
                                    class="btn btn-primary btn-lg me-2">
                                    <i class="fas fa-redo"></i> Try Again
                                </a>
                            @endif
                            <a href="{{ route('trainers') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-search"></i> Browse Trainers
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection