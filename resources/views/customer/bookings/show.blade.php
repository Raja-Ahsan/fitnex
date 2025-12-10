@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Booking Details #{{ $booking->id }}</h4>
                        <span>
                            @if($booking->booking_status == 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif($booking->booking_status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($booking->booking_status == 'cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @elseif($booking->booking_status == 'completed')
                                <span class="badge bg-info">Completed</span>
                            @endif
                        </span>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="row">
                            <!-- Trainer Information -->
                            <div class="col-md-6 mb-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h5><i class="fas fa-user-tie"></i> Trainer Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Name:</strong> {{ $booking->trainer->name }}</p>
                                        <p><strong>Designation:</strong> {{ $booking->trainer->designation }}</p>
                                        <p><strong>Email:</strong> {{ $booking->trainer->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Session Information -->
                            <div class="col-md-6 mb-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h5><i class="fas fa-calendar-check"></i> Session Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Date:</strong> {{ $booking->timeSlot->formatted_date }}</p>
                                        <p><strong>Time:</strong> {{ $booking->timeSlot->formatted_time }}</p>
                                        <p><strong>Duration:</strong>
                                            {{ $booking->timeSlot->availability->session_duration ?? 'N/A' }} minutes</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div class="col-md-6 mb-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h5><i class="fas fa-dollar-sign"></i> Payment Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Price:</strong> ${{ number_format($booking->price, 2) }}</p>
                                        <p>
                                            <strong>Payment Status:</strong>
                                            @if($booking->payment_status == 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @elseif($booking->payment_status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($booking->payment_status == 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @elseif($booking->payment_status == 'refunded')
                                                <span class="badge bg-info">Refunded</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Status -->
                            <div class="col-md-6 mb-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h5><i class="fas fa-info-circle"></i> Booking Status</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Booked On:</strong> {{ $booking->created_at->format('M d, Y h:i A') }}
                                        </p>
                                        @if($booking->cancelled_at)
                                            <p><strong>Cancelled On:</strong>
                                                {{ $booking->cancelled_at->format('M d, Y h:i A') }}</p>
                                            @if($booking->cancellation_reason)
                                                <p><strong>Cancellation Reason:</strong> {{ $booking->cancellation_reason }}</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        @if($booking->notes)
                            <div class="card bg-light mb-4">
                                <div class="card-header">
                                    <h5><i class="fas fa-sticky-note"></i> Your Notes</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $booking->notes }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Reschedule History -->
                        @if($booking->reschedules->isNotEmpty())
                            <div class="card bg-light mb-4">
                                <div class="card-header">
                                    <h5><i class="fas fa-history"></i> Reschedule History</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($booking->reschedules as $reschedule)
                                                    <tr>
                                                        <td>{{ $reschedule->created_at->format('M d, Y') }}</td>
                                                        <td>{{ $reschedule->oldSlot->formatted_time }}</td>
                                                        <td>{{ $reschedule->newSlot->formatted_time }}</td>
                                                        <td>{{ $reschedule->reason ?? 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('customer.bookings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to My Bookings
                            </a>

                            @if($booking->canBeRescheduled())
                                <a href="{{ route('customer.bookings.reschedule', $booking->id) }}" class="btn btn-warning">
                                    <i class="fas fa-calendar-alt"></i> Reschedule Booking
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection