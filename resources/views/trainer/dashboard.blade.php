@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Trainer Dashboard</h2>
            </div>
        </div>

        <!-- Statistics Overview -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Total Bookings</h6>
                                <h2 class="mb-0">{{ $stats['total_bookings'] }}</h2>
                            </div>
                            <i class="fas fa-calendar-check fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">This Month</h6>
                                <h2 class="mb-0">{{ $stats['this_month'] }}</h2>
                            </div>
                            <i class="fas fa-chart-line fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Pending</h6>
                                <h2 class="mb-0">{{ $stats['pending'] }}</h2>
                            </div>
                            <i class="fas fa-clock fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Total Revenue</h6>
                                <h2 class="mb-0">${{ number_format($stats['total_revenue'], 2) }}</h2>
                            </div>
                            <i class="fas fa-dollar-sign fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('trainer.availability.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-calendar-alt"></i> Manage Availability
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('trainer.pricing.index') }}" class="btn btn-outline-success w-100">
                                    <i class="fas fa-dollar-sign"></i> Update Pricing
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('trainer.bookings.index') }}" class="btn btn-outline-info w-100">
                                    <i class="fas fa-list"></i> View All Bookings
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('trainer.google.index') }}" class="btn btn-outline-warning w-100">
                                    <i class="fab fa-google"></i> Google Calendar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Sessions -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Upcoming Sessions</h5>
                        <a href="{{ route('trainer.bookings.index') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body">
                        @if($upcomingBookings->isEmpty())
                            <p class="text-muted text-center py-4">No upcoming sessions scheduled.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Customer</th>
                                            <th>Duration</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($upcomingBookings as $booking)
                                            <tr>
                                                <td>
                                                    <strong>{{ $booking->timeSlot->formatted_date }}</strong><br>
                                                    <small>{{ $booking->timeSlot->formatted_time }}</small>
                                                </td>
                                                <td>
                                                    {{ $booking->user->name }}<br>
                                                    <small class="text-muted">{{ $booking->user->email }}</small>
                                                </td>
                                                <td>{{ $booking->timeSlot->availability->session_duration ?? 'N/A' }} min</td>
                                                <td>
                                                    @if($booking->booking_status == 'confirmed')
                                                        <span class="badge bg-success">Confirmed</span>
                                                    @elseif($booking->booking_status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Bookings</h5>
                    </div>
                    <div class="card-body">
                        @if($recentBookings->isEmpty())
                            <p class="text-muted text-center py-3">No recent bookings.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($recentBookings as $booking)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $booking->user->name }}</strong><br>
                                            <small class="text-muted">{{ $booking->created_at->diffForHumans() }}</small>
                                        </div>
                                        <span class="badge bg-primary">${{ number_format($booking->price, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Availability Status</h5>
                    </div>
                    <div class="card-body">
                        @if($availabilities->isEmpty())
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> You haven't set up your availability yet.
                                <a href="{{ route('trainer.availability.create') }}">Add availability</a> to start accepting
                                bookings.
                            </div>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($availabilities as $availability)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $availability->day_name }}</strong><br>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }} -
                                                {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}
                                            </small>
                                        </div>
                                        @if($availability->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection