@extends('layouts.admin.app')

@section('title', $page_title)

@section('content')
<section class="content-header">
    <h1>{{ $page_title }}</h1>
</section>

<section class="content">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Bookings</span>
                    <span class="info-box-number">{{ $stats['total_bookings'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Appointments</span>
                    <span class="info-box-number">{{ $stats['total_appointments'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Confirmed</span>
                    <span class="info-box-number">{{ $stats['confirmed_bookings'] + $stats['confirmed_appointments'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-blue">
                <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Revenue</span>
                    <span class="info-box-number">${{ number_format($stats['total_revenue'], 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Section -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Bookings</h3>
            <div class="box-tools pull-right">
                <span class="label label-primary">{{ $bookings->total() }} Total</span>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if($bookings->isEmpty())
                <div class="alert alert-info">
                    <i class="fa fa-info"></i> No bookings found.
                </div>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trainer</th>
                            <th>Client</th>
                            <th>Session Time</th>
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
                                    <strong>{{ $booking->trainer->name ?? 'N/A' }}</strong>
                                </td>
                                <td>
                                    <strong>{{ $booking->user->name ?? 'Guest' }}</strong><br>
                                    <small class="text-muted">{{ $booking->user->email ?? '-' }}</small>
                                </td>
                                <td>
                                    @if($booking->timeSlot)
                                        @php
                                            $slotDateTime = \Carbon\Carbon::parse($booking->timeSlot->slot_datetime);
                                            $startTime = $slotDateTime->copy();
                                            
                                            // Get session duration from availability
                                            $sessionDuration = 60; // Default
                                            if ($booking->timeSlot->availability) {
                                                $sessionDuration = (int) ($booking->timeSlot->availability->session_duration ?? 60);
                                            }
                                            
                                            $endTime = $startTime->copy()->addMinutes($sessionDuration);
                                        @endphp
                                        <i class="fa fa-calendar text-muted"></i>
                                        {{ $slotDateTime->format('M d, Y') }}<br>
                                        <i class="fa fa-clock-o text-muted"></i>
                                        {{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>${{ number_format($booking->price, 2) }}</td>
                                <td>
                                    @if($booking->payment_status == 'paid')
                                        <span class="label label-success">Paid</span>
                                    @else
                                        <span class="label label-warning">{{ ucfirst($booking->payment_status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->booking_status == 'confirmed')
                                        <span class="label label-success">Confirmed</span>
                                    @elseif($booking->booking_status == 'pending')
                                        <span class="label label-warning">Pending</span>
                                    @elseif($booking->booking_status == 'cancelled')
                                        <span class="label label-danger">Cancelled</span>
                                    @else
                                        <span class="label label-info">{{ ucfirst($booking->booking_status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-xs btn-info">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Appointments Section -->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">All Appointments</h3>
            <div class="box-tools pull-right">
                <span class="label label-success">{{ $appointments->total() }} Total</span>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if($appointments->isEmpty())
                <div class="alert alert-info">
                    <i class="fa fa-info"></i> No appointments found.
                </div>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trainer</th>
                            <th>Client</th>
                            <th>Date & Time</th>
                            <th>Price</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>#{{ $appointment->id }}</td>
                                <td>
                                    <strong>{{ $appointment->trainer->name ?? 'N/A' }}</strong>
                                </td>
                                <td>
                                    <strong>{{ $appointment->user->name ?? $appointment->name }}</strong><br>
                                    <small class="text-muted">{{ $appointment->user->email ?? $appointment->email }}</small>
                                </td>
                                <td>
                                    @php
                                        $appointmentDate = \Carbon\Carbon::parse($appointment->appointment_date);
                                        $startTime = \Carbon\Carbon::parse($appointment->appointment_time);
                                        
                                        // Get session duration from trainer's availability
                                        $dayOfWeek = $appointmentDate->dayOfWeek;
                                        $availability = \App\Models\Availability::where('trainer_id', $appointment->trainer_id)
                                            ->where('day_of_week', $dayOfWeek)
                                            ->where('is_active', true)
                                            ->first();
                                        $sessionDuration = (int) ($availability->session_duration ?? 60);
                                        $endTime = $startTime->copy()->addMinutes($sessionDuration);
                                    @endphp
                                    <i class="fa fa-calendar text-muted"></i>
                                    {{ $appointmentDate->format('M d, Y') }}<br>
                                    <i class="fa fa-clock-o text-muted"></i>
                                    {{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}
                                </td>
                                <td>${{ number_format($appointment->price, 2) }}</td>
                                <td>
                                    @if($appointment->payment_status == 'paid')
                                        <span class="label label-success">Paid</span>
                                    @else
                                        <span class="label label-warning">{{ ucfirst($appointment->payment_status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($appointment->status == 'confirmed')
                                        <span class="label label-success">Confirmed</span>
                                    @elseif($appointment->status == 'pending')
                                        <span class="label label-warning">Pending</span>
                                    @elseif($appointment->status == 'cancelled')
                                        <span class="label label-danger">Cancelled</span>
                                    @else
                                        <span class="label label-info">{{ ucfirst($appointment->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.appointments.show', $appointment->id) }}" class="btn btn-xs btn-info">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

