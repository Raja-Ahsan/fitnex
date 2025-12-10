@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Blocked Time Slots</h2>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('trainer.slots.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to All Slots
                </a>
                <a href="{{ route('trainer.slots.block-form') }}" class="btn btn-warning">
                    <i class="fas fa-ban"></i> Block New Slots
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Blocked Periods ({{ $blockedSlots->total() }} total)</h5>
            </div>
            <div class="card-body">
                @if($blockedSlots->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> You haven't blocked any time slots yet.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Start Date & Time</th>
                                    <th>End Date & Time</th>
                                    <th>Duration</th>
                                    <th>Reason</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blockedSlots as $blocked)
                                    <tr>
                                        <td>
                                            <strong>{{ $blocked->start_datetime->format('M d, Y') }}</strong><br>
                                            <small>{{ $blocked->start_datetime->format('h:i A') }}</small>
                                        </td>
                                        <td>
                                            <strong>{{ $blocked->end_datetime->format('M d, Y') }}</strong><br>
                                            <small>{{ $blocked->end_datetime->format('h:i A') }}</small>
                                        </td>
                                        <td>
                                            @php
                                                $duration = $blocked->start_datetime->diffInHours($blocked->end_datetime);
                                            @endphp
                                            {{ $duration }} hours
                                        </td>
                                        <td>{{ $blocked->reason ?? '-' }}</td>
                                        <td>
                                            <form action="{{ route('trainer.slots.unblock', $blocked->id) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Are you sure you want to unblock this time period?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i> Unblock
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $blockedSlots->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection