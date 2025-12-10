@extends('layouts.trainer.app')

@section('content')
    <div class="content-header">
        <h1>
            My Bookings
            <small>Manage your appointments</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Bookings</li>
        </ol>
    </div>

    <section class="content">
        <!-- Statistics CArds -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-calendar-check-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Bookings</span>
                        <span class="info-box-number">{{ $stats['total'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">{{ $stats['pending'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Confirmed</span>
                        <span class="info-box-number">{{ $stats['confirmed'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-flag-checkered"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Completed</span>
                        <span class="info-box-number">{{ $stats['completed'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="box box-default collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Filter Bookings</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                            class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form method="GET" action="{{ route('trainer.bookings.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Booking Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                                        Confirmed</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="payment_status">Payment Status</label>
                                <select name="payment_status" id="payment_status" class="form-control">
                                    <option value="">All Payments</option>
                                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid
                                    </option>
                                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>
                                        Failed</option>
                                    <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>
                                        Refunded</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date_from">From Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="date" name="date_from" id="date_from" class="form-control"
                                        value="{{ request('date_from') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date_to">To Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="date" name="date_to" id="date_to" class="form-control"
                                        value="{{ request('date_to') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end" style="margin-top: 25px;">
                            <button type="submit" class="btn btn-primary w-100"
                                style="background-color: #004b85; border-color: #004b85;">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="box box-primary" style="border-top-color: #004b85;">
            <div class="box-header with-border">
                <h3 class="box-title">Bookings List</h3>
                <div class="box-tools pull-right">
                    <span class="label label-primary">{{ $bookings->total() }} Total</span>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible" style="margin: 10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if($bookings->isEmpty())
                    <div class="alert alert-info" style="margin: 20px;">
                        <i class="icon fa fa-info"></i> No bookings found.
                    </div>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client Info</th>
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
                                        <strong>{{ $booking->name ?? ($booking->user->name ?? 'Guest') }}</strong><br>
                                        <small class="text-muted">{{ $booking->email ?? ($booking->user->email ?? '-') }}</small>
                                    </td>
                                    <td>
                                        @if($booking->appointment_date)
                                            <i class="fa fa-calendar text-muted"></i>
                                            {{ \Carbon\Carbon::parse($booking->appointment_date)->format('M d, Y') }}<br>
                                            <i class="fa fa-clock-o text-muted"></i>
                                            {{ \Carbon\Carbon::parse($booking->appointment_time)->format('h:i A') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($booking->price, 2) }}</td>
                                    <td>
                                        @if($booking->payment_status == 'paid' || $booking->payment_status == 'completed')
                                            <span class="label label-success">Paid</span>
                                        @elseif($booking->payment_status == 'pending')
                                            <span class="label label-warning">Pending</span>
                                        @elseif($booking->payment_status == 'failed')
                                            <span class="label label-danger">Failed</span>
                                        @else
                                            <span class="label label-default">{{ ucfirst($booking->payment_status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->status == 'confirmed')
                                            <span class="label label-success">Confirmed</span>
                                        @elseif($booking->status == 'pending')
                                            <span class="label label-warning">Pending</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="label label-danger">Cancelled</span>
                                        @elseif($booking->status == 'completed')
                                            <span class="label label-info">Completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('trainer.bookings.show', $booking->id) }}" class="btn btn-xs btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            @if($bookings->hasPages())
                <div class="box-footer clearfix">
                    {{ $bookings->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </section>
@endsection