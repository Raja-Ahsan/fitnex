@extends('layouts.trainer.app')

@section('content')
    <section class="content-header">
        <h1>
            Trainer Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #004b85; color: white;">
                    <div class="inner">
                        <h3>{{ $stats['total_bookings'] }}</h3>
                        <p>Total Bookings</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-check-o"></i>
                    </div>
                    <a href="{{ route('trainer.bookings.index') }}" class="small-box-footer"
                        style="background-color: rgba(0,0,0,0.1); color: white;">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #c58501; color: white;">
                    <div class="inner">
                        <h3>{{ $stats['this_month'] }}</h3>
                        <p>This Month</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <a href="#" class="small-box-footer" style="background-color: rgba(0,0,0,0.1); color: white;">More
                        info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #cc8a00; color: white;">
                    <div class="inner">
                        <h3>{{ $stats['pending'] }}</h3>
                        <p>Pending Bookings</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <a href="{{ route('trainer.bookings.index') }}?status=pending" class="small-box-footer"
                        style="background-color: rgba(0,0,0,0.1); color: white;">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box" style="background-color: #005c9e; color: white;">
                    <div class="inner">
                        <h3>${{ number_format($stats['total_revenue'], 2) }}</h3>
                        <p>Total Revenue</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <a href="#" class="small-box-footer" style="background-color: rgba(0,0,0,0.1); color: white;">More
                        info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Upcoming Sessions -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Upcoming Sessions</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        @if($upcomingBookings->isEmpty())
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-info"></i> No Upcoming Sessions</h4>
                                You don't have any sessions scheduled for the next 7 days.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($upcomingBookings as $booking)
                                            <tr>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($booking->appointment_date)->format('M d, Y') }}<br>
                                                    <small class="label label-primary"><i class="fa fa-clock-o"></i>
                                                        {{ \Carbon\Carbon::parse($booking->appointment_time)->format('h:i A') }}</small>
                                                </td>
                                                <td>{{ $booking->name ?? ($booking->user->name ?? 'Guest') }}</td>
                                                <td>
                                                    @if($booking->status == 'confirmed')
                                                        <span class="label label-success">Confirmed</span>
                                                    @elseif($booking->status == 'pending')
                                                        <span class="label label-warning">Pending</span>
                                                    @else
                                                        <span class="label label-default">{{ ucfirst($booking->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('trainer.bookings.show', $booking->id) }}"
                                                        class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="box-footer clearfix">
                        <a href="{{ route('trainer.bookings.index') }}"
                            class="btn btn-sm btn-default btn-flat pull-right">View All Bookings</a>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Quick Actions</h3>
                    </div>
                    <div class="box-body text-center">
                        <a class="btn btn-app" href="{{ route('trainer.availability.index') }}">
                            <i class="fa fa-calendar-check-o"></i> Availability
                        </a>
                        <a class="btn btn-app" href="{{ route('trainer.pricing.index') }}">
                            <i class="fa fa-usd"></i> Pricing
                        </a>
                        <a class="btn btn-app" href="{{ route('trainer.bookings.index') }}">
                            <i class="fa fa-list"></i> Bookings
                        </a>
                        <a class="btn btn-app" href="{{ route('trainer.google.index') }}">
                            <i class="fa fa-google"></i> Google Sync
                        </a>
                        <a class="btn btn-app" href="{{ route('trainer.profile.edit') }}">
                            <i class="fa fa-user"></i> Profile
                        </a>
                    </div>
                </div>
            </section>
            <!-- /.Left col -->

            <!-- Right col -->
            <section class="col-lg-5 connectedSortable">
                <!-- Recent Activity -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recent Activity</h3>
                    </div>
                    <div class="box-body">
                        @if($recentBookings->isEmpty())
                            <p class="text-muted text-center">No recent activity.</p>
                        @else
                            <ul class="products-list product-list-in-box">
                                @foreach($recentBookings as $booking)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{ $booking->user && $booking->user->image ? asset('storage/' . $booking->user->image) : asset('assets/images/user-placeholder.png') }}"
                                                alt="User Image">
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('trainer.bookings.show', $booking->id) }}"
                                                class="product-title">{{ $booking->name ?? ($booking->user->name ?? 'Guest') }}
                                                <span
                                                    class="label label-success pull-right">${{ number_format($booking->price, 2) }}</span></a>
                                            <span class="product-description">
                                                Booked for {{ \Carbon\Carbon::parse($booking->appointment_date)->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{ route('trainer.bookings.index') }}" class="uppercase">View All Bookings</a>
                    </div>
                </div>

                <!-- Availability Status -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Availability Overview</h3>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th style="width: 40px">Status</th>
                            </tr>
                            @foreach($availabilities as $index => $availability)
                                <tr>
                                    <td>{{ $index + 1 }}.</td>
                                    <td>{{ $availability->day_name }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }} -
                                        {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}
                                    </td>
                                    <td>
                                        @if($availability->is_active)
                                            <span class="badge bg-green">Active</span>
                                        @else
                                            <span class="badge bg-red">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @if($availabilities->isEmpty())
                            <div class="pad margin">
                                <div class="callout callout-warning" style="margin-bottom: 0!important;">
                                    <h4><i class="fa fa-info"></i> Note:</h4>
                                    You have not set up your availability schema yet.
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="box-footer clearfix">
                        <a href="{{ route('trainer.availability.create') }}"
                            class="btn btn-sm btn-info btn-flat pull-right">Manage Availability</a>
                    </div>
                </div>
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </section>
@endsection