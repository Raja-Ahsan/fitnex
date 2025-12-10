@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-success">
                    <div class="card-header bg-success text-white text-center">
                        <h3><i class="fas fa-check-circle"></i> Payment Successful!</h3>
                    </div>
                    <div class="card-body text-center py-5">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>

                        <h4 class="mt-4">Your booking has been confirmed!</h4>
                        <p class="text-muted">Thank you for your payment. Your training session has been successfully
                            booked.</p>

                        <div class="card mt-4 mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Booking Details</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 text-start">
                                        <p><strong>Booking ID:</strong></p>
                                        <p><strong>Trainer:</strong></p>
                                        <p><strong>Date:</strong></p>
                                        <p><strong>Time:</strong></p>
                                        <p><strong>Amount Paid:</strong></p>
                                    </div>
                                    <div class="col-md-6 text-start">
                                        <p>#{{ $booking->id }}</p>
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
                            A confirmation email has been sent to your email address with all the booking details.
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('customer.bookings.index') }}" class="btn btn-primary btn-lg me-2">
                                <i class="fas fa-list"></i> View My Bookings
                            </a>
                            <a href="{{ route('trainers') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-search"></i> Book Another Session
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection