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
                <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Slots</span>
                    <span class="info-box-number">{{ $stats['total_slots'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Available</span>
                    <span class="info-box-number">{{ $stats['available_slots'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Booked</span>
                    <span class="info-box-number">{{ $stats['booked_slots'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-ban"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Blocked</span>
                    <span class="info-box-number">{{ $stats['blocked_slots'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Filter Slots</h3>
        </div>
        <div class="box-body">
            <form method="GET" action="{{ route('admin.slots.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="trainer_id">Trainer</label>
                            <select name="trainer_id" id="trainer_id" class="form-control">
                                <option value="">All Trainers</option>
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}" {{ request('trainer_id') == $trainer->id ? 'selected' : '' }}>
                                        {{ $trainer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">All Statuses</option>
                                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                                <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>Blocked</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="date_from">From Date</label>
                            <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="date_to">To Date</label>
                            <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>
                    </div>
                    <div class="col-md-2" style="margin-top: 25px;">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Slots Table -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Slots</h3>
            <div class="box-tools pull-right">
                <span class="label label-primary">{{ $slots->total() }} Total</span>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if($slots->isEmpty())
                <div class="alert alert-info">
                    <i class="fa fa-info"></i> No slots found.
                </div>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trainer</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slots as $slot)
                            <tr>
                                <td>#{{ $slot->id }}</td>
                                <td>
                                    <strong>{{ $slot->trainer->name ?? 'N/A' }}</strong>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($slot->slot_datetime)->format('M d, Y h:i A') }}
                                </td>
                                <td>
                                    @php
                                        $isBlocked = \App\Models\BlockedSlot::where('trainer_id', $slot->trainer_id)
                                            ->where('date', \Carbon\Carbon::parse($slot->slot_datetime)->format('Y-m-d'))
                                            ->where(function($q) use ($slot) {
                                                $slotTime = \Carbon\Carbon::parse($slot->slot_datetime)->format('H:i:s');
                                                $q->where('start_time', '<=', $slotTime)
                                                  ->where('end_time', '>', $slotTime);
                                            })
                                            ->exists();
                                    @endphp
                                    @if($isBlocked)
                                        <span class="label label-danger">Blocked</span>
                                    @elseif($slot->is_booked)
                                        <span class="label label-warning">Booked</span>
                                    @else
                                        <span class="label label-success">Available</span>
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($slot->created_at)->format('M d, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $slots->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

