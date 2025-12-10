@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Manage Time Slots</h2>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('trainer.slots.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Slots</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available
                            </option>
                            <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('trainer.slots.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-md-12">
                <a href="{{ route('trainer.slots.block-form') }}" class="btn btn-warning">
                    <i class="fas fa-ban"></i> Block Time Slots
                </a>
                <a href="{{ route('trainer.slots.blocked') }}" class="btn btn-info">
                    <i class="fas fa-list"></i> View Blocked Slots
                </a>
            </div>
        </div>

        <!-- Slots Table -->
        <div class="card">
            <div class="card-header">
                <h5>Time Slots ({{ $slots->total() }} total)</h5>
            </div>
            <div class="card-body">
                @if($slots->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No time slots found.
                        <a href="{{ route('trainer.availability.create') }}">Add availability</a> to generate slots.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Booking</th>
                                    <th>Available</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slots as $slot)
                                    <tr>
                                        <td>
                                            <strong>{{ $slot->slot_datetime->format('M d, Y') }}</strong><br>
                                            <small>{{ $slot->slot_datetime->format('h:i A') }}</small>
                                        </td>
                                        <td>{{ $slot->availability->session_duration ?? 'N/A' }} min</td>
                                        <td>
                                            @if($slot->is_booked)
                                                <span class="badge bg-danger">Booked</span>
                                            @elseif(!$slot->is_available)
                                                <span class="badge bg-warning">Blocked</span>
                                            @else
                                                <span class="badge bg-success">Available</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($slot->booking)
                                                <a href="{{ route('trainer.bookings.show', $slot->booking->id) }}">
                                                    {{ $slot->booking->user->name }}
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($slot->is_available)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="fas fa-times text-danger"></i>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $slots->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection