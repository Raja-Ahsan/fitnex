@extends('layouts.admin.app')

@section('title', $page_title)

@section('content')
<section class="content-header">
    <h1>{{ $page_title }}</h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Appointment Details</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Appointment Information</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Appointment ID</th>
                            <td>#{{ $appointment->id }}</td>
                        </tr>
                        <tr>
                            <th>Trainer</th>
                            <td>{{ $appointment->trainer->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Client Name</th>
                            <td>{{ $appointment->user->name ?? $appointment->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $appointment->user->email ?? $appointment->email }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td>
                                @php
                                    $startTime = \Carbon\Carbon::parse($appointment->appointment_time);
                                    
                                    // Get session duration from trainer's availability
                                    $appointmentDate = \Carbon\Carbon::parse($appointment->appointment_date);
                                    $dayOfWeek = $appointmentDate->dayOfWeek;
                                    $availability = \App\Models\Availability::where('trainer_id', $appointment->trainer_id)
                                        ->where('day_of_week', $dayOfWeek)
                                        ->where('is_active', true)
                                        ->first();
                                    $sessionDuration = (int) ($availability->session_duration ?? 60);
                                    $endTime = $startTime->copy()->addMinutes($sessionDuration);
                                @endphp
                                {{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Time Zone</th>
                            <td>{{ $appointment->time_zone }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>${{ number_format($appointment->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <td>
                                @if($appointment->payment_status == 'paid')
                                    <span class="label label-success">Paid</span>
                                @else
                                    <span class="label label-warning">{{ ucfirst($appointment->payment_status) }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
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
                        </tr>
                        @if($appointment->description)
                        <tr>
                            <th>Description</th>
                            <td>{{ $appointment->description }}</td>
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

