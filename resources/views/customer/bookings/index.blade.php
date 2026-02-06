@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>My Bookings</h2>
            </div>
        </div>

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

        <!-- Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('customer.bookings.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bookings List -->
        @if($bookings->isEmpty())
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                    <h4>No bookings found</h4>
                    <p class="text-muted">You haven't made any bookings yet.</p>
                    <a href="{{ route('trainers') }}" class="btn btn-primary">
                        <i class="fas fa-search"></i> Browse Trainers
                    </a>
                </div>
            </div>
        @else
            <div class="row">
                @foreach($bookings as $booking)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>
                                    <strong>Booking #{{ $booking->id }}</strong>
                                </span>
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
                                <h5 class="card-title">{{ $booking->trainer->name }}</h5>
                                <p class="card-text text-muted">{{ $booking->trainer->designation }}</p>

                                <div class="mb-2">
                                    <i class="fas fa-calendar text-primary"></i>
                                    <strong>Date:</strong> {{ $booking->timeSlot->formatted_date }}
                                </div>

                                <div class="mb-2">
                                    <i class="fas fa-clock text-primary"></i>
                                    <strong>Time:</strong> {{ $booking->timeSlot->formatted_time }}
                                </div>

                                <div class="mb-2">
                                    <i class="fas fa-dollar-sign text-primary"></i>
                                    <strong>Price:</strong> ${{ number_format($booking->price, 2) }}
                                </div>

                                <div class="mb-2">
                                    <i class="fas fa-credit-card text-primary"></i>
                                    <strong>Payment:</strong>
                                    @if($booking->payment_status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($booking->payment_status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($booking->payment_status == 'failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </div>

                                @if($booking->notes)
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <strong>Notes:</strong> {{ $booking->notes }}
                                        </small>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('customer.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>

                                    @if($booking->canBeRescheduled())
                                        <a href="{{ route('customer.bookings.reschedule', $booking->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-calendar-alt"></i> Reschedule
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
@endsection