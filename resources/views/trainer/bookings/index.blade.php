@extends('layouts.trainer.app')

@section('title', 'My Bookings')

@push('css')
    @include('trainer.partials.theme-styles')
@endpush

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
        <div class="trainer-themed-page">
            <div class="fitnex-hero">
                <div>
                    <h1><i class="fa fa-calendar-check-o"></i> My Bookings</h1>
                    <p>{{ $bookings->total() }} booking(s) — filter by status, payment, or date.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="fitnex-alert fitnex-alert--success" style="margin-bottom:16px;">
                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="fitnex-stat-grid">
                <div class="fitnex-stat-card">
                    <span class="fitnex-stat-card__label">Total</span>
                    <span class="fitnex-stat-card__value">{{ $stats['total'] }}</span>
                    <i class="fa fa-calendar-check-o fitnex-stat-card__icon"></i>
                </div>
                <a href="{{ route('trainer.bookings.index', ['status' => 'pending']) }}" class="fitnex-stat-card">
                    <span class="fitnex-stat-card__label">Pending</span>
                    <span class="fitnex-stat-card__value">{{ $stats['pending'] }}</span>
                    <i class="fa fa-clock-o fitnex-stat-card__icon"></i>
                </a>
                <a href="{{ route('trainer.bookings.index', ['status' => 'confirmed']) }}" class="fitnex-stat-card">
                    <span class="fitnex-stat-card__label">Confirmed</span>
                    <span class="fitnex-stat-card__value">{{ $stats['confirmed'] }}</span>
                    <i class="fa fa-check fitnex-stat-card__icon"></i>
                </a>
                <a href="{{ route('trainer.bookings.index', ['status' => 'completed']) }}" class="fitnex-stat-card">
                    <span class="fitnex-stat-card__label">Completed</span>
                    <span class="fitnex-stat-card__value">{{ $stats['completed'] }}</span>
                    <i class="fa fa-flag-checkered fitnex-stat-card__icon"></i>
                </a>
            </div>

            <div class="fitnex-panel" style="margin-bottom:20px;">
                <div class="fitnex-filter-toggle" onclick="document.getElementById('bookingsFilterBody').classList.toggle('collapsed');">
                    <span><i class="fa fa-filter"></i> Filter bookings</span>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <div class="fitnex-filter-body {{ request()->hasAny(['status','payment_status','date_from','date_to']) ? '' : 'collapsed' }}" id="bookingsFilterBody">
                    <form method="GET" action="{{ route('trainer.bookings.index') }}">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Booking status</label>
                                    <select name="status" class="form-control">
                                        <option value="">All statuses</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Payment status</label>
                                    <select name="payment_status" class="form-control">
                                        <option value="">All payments</option>
                                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="control-label">From date</label>
                                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="control-label">To date</label>
                                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                                </div>
                            </div>
                        </div>
                        <div class="fitnex-actions">
                            <button type="submit" class="btn btn-fit-primary"><i class="fa fa-search"></i> Apply</button>
                            <a href="{{ route('trainer.bookings.index') }}" class="btn btn-fit-outline"><i class="fa fa-refresh"></i> Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="fitnex-panel">
                <div class="fitnex-panel__head">
                    <h3><i class="fa fa-list"></i> Bookings list</h3>
                    <span class="fitnex-badge fitnex-badge--info">{{ $bookings->total() }} total</span>
                </div>
                <div class="fitnex-panel__body">
                    @if($bookings->isEmpty())
                        <div class="fitnex-alert fitnex-alert--info text-center" style="padding:28px 20px;">
                            <i class="fa fa-calendar-times-o fa-2x" style="display:block;margin-bottom:12px;"></i>
                            <strong>No bookings found.</strong>
                            <p style="margin:8px 0 0;">Try changing your filters or check back later.</p>
                        </div>
                    @else
                        <div class="fitnex-table-wrap fitnex-table-desktop">
                            <table class="table fitnex-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Session</th>
                                        <th>Price</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        @php
                                            $startTime = $booking->appointment_time ? \Carbon\Carbon::parse($booking->appointment_time) : null;
                                            $endTime = null;
                                            if ($startTime && $booking->appointment_date) {
                                                $dayOfWeek = \Carbon\Carbon::parse($booking->appointment_date)->dayOfWeek;
                                                $availability = \App\Models\Availability::where('trainer_id', $booking->trainer_id)
                                                    ->where('day_of_week', $dayOfWeek)
                                                    ->where('is_active', true)
                                                    ->first();
                                                $sessionDuration = (int) ($availability->session_duration ?? 60);
                                                $endTime = $startTime->copy()->addMinutes($sessionDuration);
                                            }
                                        @endphp
                                        <tr>
                                            <td><strong>#{{ $booking->id }}</strong></td>
                                            <td>
                                                <strong>{{ $booking->name ?? ($booking->user->name ?? 'Guest') }}</strong>
                                                <div style="font-size:12px;color:var(--fit-muted);">{{ $booking->email ?? ($booking->user->email ?? '—') }}</div>
                                                @if($booking->phone || ($booking->user && $booking->user->phone))
                                                    <div style="font-size:12px;color:var(--fit-muted);"><i class="fa fa-phone"></i> {{ $booking->phone ?? $booking->user->phone }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($booking->appointment_date && $startTime)
                                                    <strong>{{ \Carbon\Carbon::parse($booking->appointment_date)->format('M d, Y') }}</strong>
                                                    <div style="font-size:12px;color:var(--fit-muted);">
                                                        {{ $startTime->format('h:i A') }} &ndash; {{ $endTime->format('h:i A') }}
                                                    </div>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td><strong>${{ number_format($booking->price, 2) }}</strong></td>
                                            <td>
                                                @if($booking->payment_status == 'paid' || $booking->payment_status == 'completed')
                                                    <span class="fitnex-badge fitnex-badge--success">Paid</span>
                                                @elseif($booking->payment_status == 'pending')
                                                    <span class="fitnex-badge fitnex-badge--warning">Pending</span>
                                                @elseif($booking->payment_status == 'failed')
                                                    <span class="fitnex-badge fitnex-badge--danger">Failed</span>
                                                @else
                                                    <span class="fitnex-badge fitnex-badge--muted">{{ ucfirst($booking->payment_status ?? '—') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($booking->status == 'confirmed')
                                                    <span class="fitnex-badge fitnex-badge--success">Confirmed</span>
                                                @elseif($booking->status == 'pending')
                                                    <span class="fitnex-badge fitnex-badge--warning">Pending</span>
                                                @elseif($booking->status == 'cancelled')
                                                    <span class="fitnex-badge fitnex-badge--danger">Cancelled</span>
                                                @elseif($booking->status == 'completed')
                                                    <span class="fitnex-badge fitnex-badge--info">Completed</span>
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

                        <div class="booking-cards">
                            @foreach($bookings as $booking)
                                @php
                                    $startTime = $booking->appointment_time ? \Carbon\Carbon::parse($booking->appointment_time) : null;
                                    $endTime = null;
                                    if ($startTime && $booking->appointment_date) {
                                        $dayOfWeek = \Carbon\Carbon::parse($booking->appointment_date)->dayOfWeek;
                                        $availability = \App\Models\Availability::where('trainer_id', $booking->trainer_id)
                                            ->where('day_of_week', $dayOfWeek)
                                            ->where('is_active', true)
                                            ->first();
                                        $sessionDuration = (int) ($availability->session_duration ?? 60);
                                        $endTime = $startTime->copy()->addMinutes($sessionDuration);
                                    }
                                @endphp
                                <div class="booking-card">
                                    <div class="booking-card__id">#{{ $booking->id }} — {{ $booking->name ?? ($booking->user->name ?? 'Guest') }}</div>
                                    @if($booking->appointment_date && $startTime)
                                        <div class="booking-card__row">
                                            <span>Session</span>
                                            <span>{{ \Carbon\Carbon::parse($booking->appointment_date)->format('M d, Y') }}</span>
                                        </div>
                                        <div class="booking-card__row">
                                            <span>Time</span>
                                            <span>{{ $startTime->format('h:i A') }} &ndash; {{ $endTime->format('h:i A') }}</span>
                                        </div>
                                    @endif
                                    <div class="booking-card__row">
                                        <span>Price</span>
                                        <span>${{ number_format($booking->price, 2) }}</span>
                                    </div>
                                    <div class="booking-card__row">
                                        <span>Status</span>
                                        <span>
                                            @if($booking->status == 'confirmed')
                                                <span class="fitnex-badge fitnex-badge--success">Confirmed</span>
                                            @elseif($booking->status == 'pending')
                                                <span class="fitnex-badge fitnex-badge--warning">Pending</span>
                                            @elseif($booking->status == 'cancelled')
                                                <span class="fitnex-badge fitnex-badge--danger">Cancelled</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="fitnex-badge fitnex-badge--info">Completed</span>
                                            @else
                                                <span class="fitnex-badge fitnex-badge--muted">{{ ucfirst($booking->status) }}</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="fitnex-actions" style="margin-top:10px;">
                                        <a href="{{ route('trainer.bookings.show', $booking->id) }}" class="btn btn-sm btn-fit-primary" style="width:100%;">
                                            <i class="fa fa-eye"></i> View booking
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($bookings->hasPages())
                            <div class="slots-pagination" style="text-align:center;padding-top:16px;">
                                {{ $bookings->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
