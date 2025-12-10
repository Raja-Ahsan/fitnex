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

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Customer Information -->
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5><i class="fas fa-user"></i> Customer Information</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                                    <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                                    <p><strong>Phone:</strong> {{ $booking->user->phone ?? 'N/A' }}</p>
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
                                    <p><strong>Duration:</strong> {{ $booking->timeSlot->availability->session_duration ?? 'N/A' }} minutes</p>
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
                                    <p><strong>Currency:</strong> {{ $booking->currency }}</p>
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
                                    @if($booking->stripe_payment_intent)
                                        <p><strong>Payment ID:</strong> <small>{{ $booking->stripe_payment_intent }}</small></p>
                                    @endif
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
                                    <p><strong>Created:</strong> {{ $booking->created_at->format('M d, Y h:i A') }}</p>
                                    <p><strong>Last Updated:</strong> {{ $booking->updated_at->format('M d, Y h:i A') }}</p>
                                    @if($booking->cancelled_at)
                                        <p><strong>Cancelled:</strong> {{ $booking->cancelled_at->format('M d, Y h:i A') }}</p>
                                        @if($booking->cancellation_reason)
                                            <p><strong>Reason:</strong> {{ $booking->cancellation_reason }}</p>
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
                                <h5><i class="fas fa-sticky-note"></i> Customer Notes</h5>
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
                                                <th>By</th>
                                                <th>Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($booking->reschedules as $reschedule)
                                                <tr>
                                                    <td>{{ $reschedule->created_at->format('M d, Y') }}</td>
                                                    <td>{{ $reschedule->oldSlot->formatted_time }}</td>
                                                    <td>{{ $reschedule->newSlot->formatted_time }}</td>
                                                    <td>{{ $reschedule->rescheduledByUser->name }}</td>
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
                        <a href="{{ route('trainer.bookings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Bookings
                        </a>

                        <div>
                            @if($booking->booking_status == 'pending' && $booking->payment_status == 'paid')
                                <form action="{{ route('trainer.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check"></i> Approve Booking
                                    </button>
                                </form>
                            @endif

                            @if($booking->booking_status == 'confirmed')
                                <a href="{{ route('trainer.bookings.reschedule', $booking->id) }}" class="btn btn-warning">
                                    <i class="fas fa-calendar-alt"></i> Reschedule
                                </a>
                                <form action="{{ route('trainer.bookings.complete', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-check-circle"></i> Mark Complete
                                    </button>
                                </form>
                            @endif

                            @if(!in_array($booking->booking_status, ['cancelled', 'completed']))
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                                    <i class="fas fa-times"></i> Cancel Booking
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('trainer.bookings.cancel', $booking->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Are you sure you want to cancel this booking?
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Cancellation Reason <span class="text-danger">*</span></label>
                        <textarea name="reason" id="reason" class="form-control" rows="3" required placeholder="Please provide a reason for cancellation..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
