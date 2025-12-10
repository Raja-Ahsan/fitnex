@extends('layouts.trainer.app')

@section('content')
    <div class="content-header">
        <h1>
            Manage Time Slots
            <small>View and manage your schedule</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Slots</li>
        </ol>
    </div>

    <section class="content">
        <!-- Quick Actions -->
        <div class="row mb-3">
            <div class="col-md-12 text-right" style="margin-bottom: 15px;">
                <a href="{{ route('trainer.slots.block-form') }}" class="btn btn-warning">
                    <i class="fa fa-ban"></i> Block Time Slots
                </a>
                <a href="{{ route('trainer.slots.blocked') }}" class="btn btn-info">
                    <i class="fa fa-list"></i> View Blocked Slots
                </a>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="box box-default collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Filter Slots</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form method="GET" action="{{ route('trainer.slots.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">All Slots</option>
                                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-top: 25px;">
                            <button type="submit" class="btn btn-primary" style="background-color: #004b85; border-color: #004b85;">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                            <a href="{{ route('trainer.slots.index') }}" class="btn btn-default">
                                <i class="fa fa-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Slots Table -->
        <div class="box box-primary" style="border-top-color: #004b85;">
            <div class="box-header with-border">
                <h3 class="box-title">Time Slots</h3>
                <div class="box-tools pull-right">
                    <span class="label label-primary">{{ $slots->total() }} total</span>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                @if($slots->isEmpty())
                    <div class="alert alert-info" style="margin: 20px;">
                        <i class="icon fa fa-info"></i> No time slots found. 
                        <a href="{{ route('trainer.availability.create') }}" style="color: #fff; text-decoration: underline;">Add availability</a> to generate slots.
                    </div>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Booking Info</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slots as $slot)
                                <tr>
                                    <td>
                                        <strong>{{ $slot->slot_datetime->format('M d, Y') }}</strong>
                                        <div class="text-muted">{{ $slot->slot_datetime->format('l') }}</div>
                                    </td>
                                    <td>
                                        <i class="fa fa-clock-o text-muted"></i> {{ $slot->slot_datetime->format('h:i A') }}
                                    </td>
                                    <td>{{ $slot->availability->session_duration ?? 'N/A' }} min</td>
                                    <td>
                                        @if($slot->is_booked)
                                            <span class="label label-danger">Booked</span>
                                        @else
                                            <span class="label label-success">Available</span>
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
                                        @if(!$slot->is_booked)
                                            <i class="fa fa-check-circle text-success" title="Available for booking"></i>
                                        @else
                                            <a href="{{ route('trainer.bookings.show', $slot->booking->id) }}" class="btn btn-xs btn-default">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            @if($slots->hasPages())
                <div class="box-footer clearfix">
                    {{ $slots->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </section>
@endsection