@extends('layouts.trainer.app')

@section('title', 'Dashboard')

@push('css')
    @include('trainer.partials.theme-styles')
@endpush

@section('content')
    <div class="content-header">
        <h1>
            Trainer Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
    </div>

    <section class="content">
        <div class="trainer-themed-page">
            <div class="fitnex-hero">
                <div>
                    <h1><i class="fa fa-dashboard"></i> Welcome back</h1>
                    <p>Overview of bookings, sessions, and your schedule.</p>
                </div>
                <a href="{{ route('trainer.profile.edit') }}" class="btn btn-hero">
                    <i class="fa fa-user"></i> My profile
                </a>
            </div>

            @if(!empty($profileIncomplete))
                <div class="fitnex-alert" style="background:#fff8e1;color:#e65100;margin-bottom:16px;">
                    <i class="fa fa-exclamation-triangle"></i>
                    <strong>Complete your coach profile</strong> so clients can find you on the website.
                    <a href="{{ route('trainer.profile.edit') }}" style="color:#004274;font-weight:700;margin-left:6px;">Edit profile</a>
                </div>
            @endif

            <div class="fitnex-stat-grid">
                <a href="{{ route('trainer.bookings.index') }}" class="fitnex-stat-card">
                    <span class="fitnex-stat-card__label">Total bookings</span>
                    <span class="fitnex-stat-card__value">{{ $stats['total_bookings'] }}</span>
                    <i class="fa fa-calendar-check-o fitnex-stat-card__icon"></i>
                    <span class="fitnex-stat-card__link">View all <i class="fa fa-arrow-right"></i></span>
                </a>
                <div class="fitnex-stat-card fitnex-stat-card--accent">
                    <span class="fitnex-stat-card__label">This month</span>
                    <span class="fitnex-stat-card__value">{{ $stats['this_month'] }}</span>
                    <i class="fa fa-bar-chart fitnex-stat-card__icon"></i>
                </div>
                <a href="{{ route('trainer.bookings.index', ['status' => 'pending']) }}" class="fitnex-stat-card">
                    <span class="fitnex-stat-card__label">Pending</span>
                    <span class="fitnex-stat-card__value">{{ $stats['pending'] }}</span>
                    <i class="fa fa-clock-o fitnex-stat-card__icon"></i>
                    <span class="fitnex-stat-card__link">Review pending <i class="fa fa-arrow-right"></i></span>
                </a>
                <div class="fitnex-stat-card">
                    <span class="fitnex-stat-card__label">Total revenue</span>
                    <span class="fitnex-stat-card__value">${{ number_format($stats['total_revenue'], 2) }}</span>
                    <i class="fa fa-dollar fitnex-stat-card__icon"></i>
                </div>
            </div>

            <div class="fitnex-dash-grid">
                <div>
                    <div class="fitnex-panel" style="margin-bottom:20px;">
                        <div class="fitnex-panel__head">
                            <h3><i class="fa fa-calendar"></i> Upcoming sessions (7 days)</h3>
                        </div>
                        <div class="fitnex-panel__body">
                            @if($upcomingBookings->isEmpty())
                                <div class="fitnex-alert fitnex-alert--info text-center" style="padding:24px 16px;">
                                    <i class="fa fa-calendar-times-o fa-2x" style="display:block;margin-bottom:10px;"></i>
                                    <strong>No upcoming sessions</strong>
                                    <p style="margin:8px 0 0;">Nothing scheduled for the next 7 days.</p>
                                </div>
                            @else
                                <div class="fitnex-table-wrap fitnex-table-desktop">
                                    <table class="table fitnex-table">
                                        <thead>
                                            <tr>
                                                <th>Date &amp; time</th>
                                                <th>Client</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($upcomingBookings as $booking)
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
                                                <tr>
                                                    <td>
                                                        <strong>{{ \Carbon\Carbon::parse($booking->appointment_date)->format('M d, Y') }}</strong>
                                                        <div style="font-size:12px;color:var(--fit-muted);margin-top:4px;">
                                                            {{ $startTime->format('h:i A') }} &ndash; {{ $endTime->format('h:i A') }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $booking->name ?? ($booking->user->name ?? 'Guest') }}
                                                        @if($booking->phone || ($booking->user && $booking->user->phone))
                                                            <div style="font-size:12px;color:var(--fit-muted);"><i class="fa fa-phone"></i> {{ $booking->phone ?? $booking->user->phone }}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($booking->status == 'confirmed')
                                                            <span class="fitnex-badge fitnex-badge--success">Confirmed</span>
                                                        @elseif($booking->status == 'pending')
                                                            <span class="fitnex-badge fitnex-badge--warning">Pending</span>
                                                        @else
                                                            <span class="fitnex-badge fitnex-badge--muted">{{ ucfirst($booking->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('trainer.bookings.show', $booking->id) }}" class="btn btn-xs btn-fit-outline">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="dashboard-session-cards">
                                    @foreach($upcomingBookings as $booking)
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
                                        <div class="dashboard-session-card">
                                            <div class="dashboard-session-card__date">{{ \Carbon\Carbon::parse($booking->appointment_date)->format('l, M d') }}</div>
                                            <div class="dashboard-session-card__row">
                                                <span>Time</span>
                                                <span>{{ $startTime->format('h:i A') }} &ndash; {{ $endTime->format('h:i A') }}</span>
                                            </div>
                                            <div class="dashboard-session-card__row">
                                                <span>Client</span>
                                                <span>{{ $booking->name ?? ($booking->user->name ?? 'Guest') }}</span>
                                            </div>
                                            <div class="fitnex-actions" style="margin-top:10px;">
                                                <a href="{{ route('trainer.bookings.show', $booking->id) }}" class="btn btn-sm btn-fit-primary" style="width:100%;">
                                                    <i class="fa fa-eye"></i> View booking
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="fitnex-panel__foot">
                            <a href="{{ route('trainer.bookings.index') }}" class="btn btn-sm btn-fit-outline">
                                View all bookings <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="fitnex-panel">
                        <div class="fitnex-panel__head">
                            <h3><i class="fa fa-bolt"></i> Quick actions</h3>
                        </div>
                        <div class="fitnex-panel__body">
                            <div class="fitnex-quick-grid">
                                <a href="{{ route('trainer.availability.index') }}" class="fitnex-quick-btn">
                                    <i class="fa fa-calendar-check-o"></i> Availability
                                </a>
                                <a href="{{ route('trainer.slots.index') }}" class="fitnex-quick-btn">
                                    <i class="fa fa-th-list"></i> Time slots
                                </a>
                                <a href="{{ route('trainer.pricing.index') }}" class="fitnex-quick-btn">
                                    <i class="fa fa-usd"></i> Pricing
                                </a>
                                <a href="{{ route('trainer.bookings.index') }}" class="fitnex-quick-btn">
                                    <i class="fa fa-list"></i> Bookings
                                </a>
                                <a href="{{ route('trainer.google.index') }}" class="fitnex-quick-btn">
                                    <i class="fa fa-google"></i> Google sync
                                </a>
                                <a href="{{ route('trainer.profile.edit') }}" class="fitnex-quick-btn">
                                    <i class="fa fa-user"></i> Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="fitnex-panel" style="margin-bottom:20px;">
                        <div class="fitnex-panel__head">
                            <h3><i class="fa fa-history"></i> Recent activity</h3>
                        </div>
                        <div class="fitnex-panel__body">
                            @if($recentBookings->isEmpty())
                                <p class="text-muted text-center" style="margin:12px 0;">No recent activity.</p>
                            @else
                                <ul class="fitnex-activity-list">
                                    @foreach($recentBookings as $booking)
                                        <li class="fitnex-activity-item">
                                            <img src="{{ $booking->user && $booking->user->image ? asset('storage/' . $booking->user->image) : asset('assets/images/user-placeholder.png') }}"
                                                alt="">
                                            <div class="fitnex-activity-item__body">
                                                <a href="{{ route('trainer.bookings.show', $booking->id) }}" class="fitnex-activity-item__title">
                                                    <span>{{ $booking->name ?? ($booking->user->name ?? 'Guest') }}</span>
                                                    <span class="fitnex-badge fitnex-badge--info">${{ number_format($booking->price, 2) }}</span>
                                                </a>
                                                <div class="fitnex-activity-item__meta">
                                                    {{ \Carbon\Carbon::parse($booking->appointment_date)->format('M d, Y') }}
                                                    &middot; {{ ucfirst($booking->status) }}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="fitnex-panel__foot">
                            <a href="{{ route('trainer.bookings.index') }}" class="btn btn-sm btn-fit-outline">View all</a>
                        </div>
                    </div>

                    <div class="fitnex-panel">
                        <div class="fitnex-panel__head">
                            <h3><i class="fa fa-clock-o"></i> Availability</h3>
                        </div>
                        @if($availabilities->isEmpty())
                            <div class="fitnex-panel__body">
                                <div class="fitnex-alert fitnex-alert--info">
                                    <i class="fa fa-info-circle"></i>
                                    You have not set up your weekly availability yet.
                                </div>
                            </div>
                            <div class="fitnex-panel__foot">
                                <a href="{{ route('trainer.availability.create') }}" class="btn btn-sm btn-fit-primary">
                                    <i class="fa fa-plus"></i> Add availability
                                </a>
                            </div>
                        @else
                            <div class="fitnex-table-wrap">
                                <table class="table fitnex-table" style="margin:0;">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Hours</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($availabilities as $availability)
                                            <tr>
                                                <td><strong>{{ $availability->day_name }}</strong></td>
                                                <td style="font-size:13px;">
                                                    {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }}
                                                    &ndash;
                                                    {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}
                                                </td>
                                                <td>
                                                    <span class="fitnex-badge fitnex-badge--success">Active</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="fitnex-panel__foot">
                                <a href="{{ route('trainer.availability.index') }}" class="btn btn-sm btn-fit-outline">
                                    Manage <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
