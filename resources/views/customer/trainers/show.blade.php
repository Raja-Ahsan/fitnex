@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Trainer Header -->
        <div class="row mb-4">
            <div class="col-md-12">
                <a href="{{ route('customer.trainers.index') }}" class="btn btn-secondary mb-3">
                    <i class="fas fa-arrow-left"></i> Back to Trainers
                </a>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                    style="width: 100px; height: 100px; font-size: 48px;">
                                    {{ strtoupper(substr($trainer->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="col-md-10">
                                <h2>{{ $trainer->name }}</h2>
                                <h5 class="text-muted">{{ $trainer->designation }}</h5>
                                <p class="mt-3">{{ $trainer->description }}</p>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h3 class="text-primary">${{ number_format($trainer->price, 2) }}</h3>
                                                <small class="text-muted">Starting Price</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h3 class="text-success">{{ $stats['total_sessions'] }}</h3>
                                                <small class="text-muted">Completed Sessions</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h3 class="text-info">{{ $trainer->availabilities->count() }}</h3>
                                                <small class="text-muted">Days Available</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Options -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Session Pricing</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($trainer->pricing as $pricing)
                                @if($pricing->is_active)
                                    <div class="col-md-4 mb-3">
                                        <div class="card border-primary">
                                            <div class="card-body text-center">
                                                <h6>{{ $pricing->session_duration }} Minutes</h6>
                                                <h3 class="text-primary">${{ number_format($pricing->price, 2) }}</h3>
                                                <small class="text-muted">per session</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Availability -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Weekly Availability</h5>
                    </div>
                    <div class="card-body">
                        @if($trainer->availabilities->isEmpty())
                            <p class="text-muted">No availability set yet.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Time</th>
                                            <th>Session Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($trainer->availabilities->sortBy('day_of_week') as $availability)
                                            @if($availability->is_active)
                                                <tr>
                                                    <td><strong>{{ $availability->day_name }}</strong></td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }} -
                                                        {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}
                                                    </td>
                                                    <td>{{ $availability->session_duration }} minutes</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Available Slots -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Next Available Slots (Next 7 Days)</h5>
                    </div>
                    <div class="card-body">
                        @if($upcomingSlots->isEmpty())
                            <p class="text-muted">No available slots in the next 7 days.</p>
                        @else
                            <div class="row">
                                @foreach($upcomingSlots as $slot)
                                    <div class="col-md-3 mb-2">
                                        <div class="card border-success">
                                            <div class="card-body text-center p-2">
                                                <small><strong>{{ $slot->slot_datetime->format('M d, Y') }}</strong></small><br>
                                                <small>{{ $slot->formatted_time }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Book Now Button -->
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="{{ route('customer.schedule', $trainer->id) }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-calendar-alt"></i> Book a Session Now
                </a>
            </div>
        </div>
    </div>
@endsection