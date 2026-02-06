@extends('layouts.trainer.app')

@section('content')
    <div class="content-header">
        <h1>
            Booking Details
            <small>#{{ $booking->id }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('trainer.bookings.index') }}">Bookings</a></li>
            <li class="active">Details</li>
        </ol>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Booking Information</h3>
                        <div class="box-tools pull-right">
                            @if($booking->status == 'confirmed')
                                <span class="label label-success">Confirmed</span>
                            @elseif($booking->status == 'pending')
                                <span class="label label-warning">Pending</span>
                            @elseif($booking->status == 'cancelled')
                                <span class="label label-danger">Cancelled</span>
                            @elseif($booking->status == 'completed')
                                <span class="label label-info">Completed</span>
                            @endif
                        </div>
                    </div>
                    <div class="box-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <!-- Customer Information -->
                            <div class="col-md-6">
                                <h4 class="text-primary"><i class="fa fa-user"></i> Customer Information</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 150px">Name</th>
                                        <td>{{ $booking->name ?? ($booking->user ? $booking->user->name : 'N/A') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $booking->email ?? ($booking->user ? $booking->user->email : 'N/A') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $booking->phone ?? ($booking->user->phone ?? 'N/A') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Session Information -->
                            <div class="col-md-6">
                                <h4 class="text-primary"><i class="fa fa-calendar-check-o"></i> Session Information</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 150px">Date</th>
                                        <td>{{ \Carbon\Carbon::parse($booking->appointment_date)->format('M d, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Time</th>
                                        <td>
                                            @php
                                                $startTime = \Carbon\Carbon::parse($booking->appointment_time);
                                                $dayOfWeek = \Carbon\Carbon::parse($booking->appointment_date)->dayOfWeek;
                                                $availability = \App\Models\Availability::where('trainer_id', $booking->trainer_id)
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
                                        <td>{{ $booking->time_zone ?? 'UTC' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <!-- Payment Information -->
                            <div class="col-md-6">
                                <h4 class="text-primary"><i class="fa fa-dollar"></i> Payment Information</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 150px">Price</th>
                                        <td>${{ number_format($booking->price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Status</th>
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
                                    </tr>
                                    @if($booking->stripe_session_id)
                                        <tr>
                                            <th>Stripe Session</th>
                                            <td><small
                                                    class="text-muted">{{ Str::limit($booking->stripe_session_id, 20) }}</small>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- Booking Meta -->
                            <div class="col-md-6">
                                <h4 class="text-primary"><i class="fa fa-info-circle"></i> Booking Meta</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 150px">Created At</th>
                                        <td>{{ $booking->created_at->format('M d, Y h:i A') }}</td>
                                    </tr>
                                    @if($booking->description)
                                        <tr>
                                            <th>Notes</th>
                                            <td>{{ $booking->description }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{{ route('trainer.bookings.index') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>

                        <div class="pull-right">
                            @if($booking->status == 'pending' && ($booking->payment_status == 'paid' || $booking->payment_status == 'completed'))
                                <form action="{{ route('trainer.bookings.approve', $booking->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Approve
                                    </button>
                                </form>
                            @endif

                            @if($booking->status == 'confirmed')
                                <form action="{{ route('trainer.bookings.complete', $booking->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-check-circle"></i> Mark Complete
                                    </button>
                                </form>
                            @endif

                            @if(!in_array($booking->status, ['cancelled', 'completed']))
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">
                                    <i class="fa fa-times"></i> Cancel
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Quick View Side Widget -->
            @if($booking->user)
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                                src="{{ $booking->user->image ? asset('storage/' . $booking->user->image) : asset('assets/images/user-placeholder.png') }}"
                                alt="User profile picture">

                            <h3 class="profile-username text-center">{{ $booking->user->name }}</h3>

                            <p class="text-muted text-center">Client</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="pull-right">{{ Str::limit($booking->user->email, 20) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="pull-right">{{ $booking->phone ?? ($booking->user->phone ?? 'N/A') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Joined</b> <a class="pull-right">{{ $booking->user->created_at->format('M Y') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Cancel Booking</h4>
                </div>
                <form action="{{ route('trainer.bookings.cancel', $booking->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> Are you sure you want to cancel this booking?
                        </div>
                        <div class="form-group">
                            <label for="reason">Cancellation Reason <span class="text-danger">*</span></label>
                            <textarea name="reason" id="reason" class="form-control" rows="3" required
                                placeholder="Reason for cancellation..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection