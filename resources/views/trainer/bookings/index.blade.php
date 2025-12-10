@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>My Bookings</h2>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Bookings</h5>
                        <h2>{{ $stats['total'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Pending</h5>
                        <h2>{{ $stats['pending'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Confirmed</h5>
                        <h2>{{ $stats['confirmed'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Completed</h5>
                        <h2>{{ $stats['completed'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('trainer.bookings.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="status" class="form-label">Booking Status</label>
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
                    <div class="col-md-3">
                        <label for="payment_status" class="form-label">Payment Status</label>
                        <select name="payment_status" id="payment_status" class="form-select">
                            <option value="">All Payments</option>
                            <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed
                            </option>
                            <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="date_from" class="form-label">From Date</label>
                        <input type="date" name="date_from" id="date_from" class="form-control"
                            value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="date_to" class="form-label">To Date</label>
                        <input type="date" name="date_to" id="date_to" class="form-control"
                            value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($bookings->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No bookings found.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Date & Time</th>
                                    <th>Price</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>#{{ $booking->id }}</td>
                                        <td>
                                            <strong>{{ $booking->user->name }}</strong><br>
                                            <small class="text-muted">{{ $booking->user->email }}</small>
                                        </td>
                                        <td>
                                            <i class="fas fa-calendar"></i> {{ $booking->timeSlot->formatted_date }}<br>
                                            <i class="fas fa-clock"></i> {{ $booking->timeSlot->formatted_time }}
                                        </td>
                                        <td>${{ number_format($booking->price, 2) }}</td>
                                        <td>
                                            @if($booking->payment_status == 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @elseif($booking->payment_status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($booking->payment_status == 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($booking->payment_status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($booking->booking_status == 'confirmed')
                                                <span class="badge bg-success">Confirmed</span>
                                            @elseif($booking->booking_status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($booking->booking_status == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @elseif($booking->booking_status == 'completed')
                                                <span class="badge bg-info">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('trainer.bookings.show', $booking->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection