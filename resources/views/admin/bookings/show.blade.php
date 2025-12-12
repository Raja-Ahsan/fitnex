@extends('layouts.admin.app')

@section('title', $page_title)

@section('content')
<section class="content-header">
    <h1>{{ $page_title }}</h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Booking Details</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Booking Information</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Booking ID</th>
                            <td>#{{ $booking->id }}</td>
                        </tr>
                        <tr>
                            <th>Trainer</th>
                            <td>{{ $booking->trainer->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Client</th>
                            <td>{{ $booking->user->name ?? 'Guest' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $booking->user->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $booking->phone ?? ($booking->user->phone ?? '-') }}</td>
                        </tr>
                        <tr>
                            <th>Session Time</th>
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
                                    <strong>Date:</strong> {{ $slotDateTime->format('M d, Y') }}<br>
                                    <strong>Time:</strong> {{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>${{ number_format($booking->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <td>
                                @if($booking->payment_status == 'paid')
                                    <span class="label label-success">Paid</span>
                                @else
                                    <span class="label label-warning">{{ ucfirst($booking->payment_status) }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Booking Status</th>
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
                        </tr>
                        @if($booking->notes)
                        <tr>
                            <th>Notes</th>
                            <td>{{ $booking->notes }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-default">
                        <i class="fa fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

