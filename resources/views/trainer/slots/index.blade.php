@extends('layouts.trainer.app')

@section('title', 'Time Slots')

@push('css')
    @include('trainer.partials.theme-styles')
    <style>
        .slots-filter-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            padding: 14px 18px;
            background: var(--fit-bg, #f4f8fc);
            border-bottom: 1px solid var(--fit-border, #e5eaf0);
            font-weight: 700;
            color: var(--fit-primary, #004274);
        }
        .slots-filter-body { padding: 18px; }
        .slots-filter-body.collapsed { display: none; }
        .slot-card {
            border: 1px solid var(--fit-border, #e5eaf0);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 12px;
            background: var(--fit-bg, #f4f8fc);
        }
        .slot-card__date {
            font-size: 16px;
            font-weight: 700;
            color: var(--fit-primary, #004274);
        }
        .slot-card__row {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            font-size: 13px;
            margin-top: 6px;
            color: #4a5a6a;
        }
        .slot-card__row span:first-child { color: var(--fit-muted, #6c7a88); }
        .slots-pagination { text-align: center; padding: 16px 0 4px; }
        .slots-pagination .pagination { margin: 0; }
        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        @media (max-width: 767px) {
            .fitnex-table-desktop { display: none; }
            .slots-cards { display: block; }
            .hero-actions { width: 100%; }
            .hero-actions .btn { flex: 1; min-width: calc(50% - 4px); text-align: center; }
        }
        @media (min-width: 768px) {
            .slots-cards { display: none; }
        }
    </style>
@endpush

@section('content')
    <div class="content-header">
        <h1>
            Time Slots
            <small>View and manage your schedule</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Slots</li>
        </ol>
    </div>

    <section class="content">
        <div class="trainer-themed-page">
            <div class="fitnex-hero">
                <div>
                    <h1><i class="fa fa-th-list"></i> My Time Slots</h1>
                    <p>{{ $slots->total() }} slot(s) — filter by date or status below.</p>
                </div>
                <div class="hero-actions">
                    <a href="{{ route('trainer.slots.block-form') }}" class="btn btn-hero" style="background:#fff8e1;color:#e65100;">
                        <i class="fa fa-ban"></i> Block time
                    </a>
                    <a href="{{ route('trainer.slots.blocked') }}" class="btn btn-hero">
                        <i class="fa fa-list"></i> Blocked list
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="fitnex-alert fitnex-alert--success" style="margin-bottom:16px;">
                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="fitnex-panel" style="margin-bottom:20px;">
                <div class="slots-filter-toggle" onclick="document.getElementById('slotsFilterBody').classList.toggle('collapsed');">
                    <span><i class="fa fa-filter"></i> Filter slots</span>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <div class="slots-filter-body {{ request()->hasAny(['start_date','end_date','status']) ? '' : 'collapsed' }}" id="slotsFilterBody">
                    <form method="GET" action="{{ route('trainer.slots.index') }}">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Start date</label>
                                    <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">End date</label>
                                    <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">All slots</option>
                                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="fitnex-actions">
                            <button type="submit" class="btn btn-fit-primary"><i class="fa fa-search"></i> Apply</button>
                            <a href="{{ route('trainer.slots.index') }}" class="btn btn-fit-outline"><i class="fa fa-refresh"></i> Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="fitnex-panel">
                <div class="fitnex-panel__body">
                    @if($slots->isEmpty())
                        <div class="fitnex-alert fitnex-alert--info text-center" style="padding:28px 20px;">
                            <i class="fa fa-calendar-times-o fa-2x" style="display:block;margin-bottom:12px;"></i>
                            <strong>No time slots found.</strong>
                            <p style="margin:10px 0 16px;">Add availability to generate bookable slots.</p>
                            <a href="{{ route('trainer.availability.create') }}" class="btn btn-fit-primary">
                                <i class="fa fa-plus"></i> Add availability
                            </a>
                        </div>
                    @else
                        <div class="fitnex-table-wrap fitnex-table-desktop">
                            <table class="table fitnex-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Booking</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($slots as $slot)
                                        <tr>
                                            <td>
                                                <strong>{{ $slot->slot_datetime->format('M d, Y') }}</strong>
                                                <div class="text-muted" style="font-size:12px;">{{ $slot->slot_datetime->format('l') }}</div>
                                            </td>
                                            <td>
                                                {{ $slot->slot_datetime->format('h:i A') }}
                                                &ndash;
                                                {{ $slot->slot_datetime->copy()->addMinutes((int) ($slot->availability->session_duration ?? 60))->format('h:i A') }}
                                            </td>
                                            <td>
                                                <span class="fitnex-badge fitnex-badge--info">{{ $slot->availability->session_duration ?? 'N/A' }} min</span>
                                            </td>
                                            <td>
                                                @if($slot->is_booked)
                                                    <span class="fitnex-badge" style="background:rgba(198,40,40,0.12);color:#c62828;">Booked</span>
                                                @else
                                                    <span class="fitnex-badge fitnex-badge--success">Available</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($slot->booking)
                                                    <a href="{{ route('trainer.bookings.show', $slot->booking->id) }}">{{ $slot->booking->user->name ?? 'View' }}</a>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($slot->is_booked && $slot->booking)
                                                    <a href="{{ route('trainer.bookings.show', $slot->booking->id) }}" class="btn btn-xs btn-fit-outline">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                @else
                                                    <i class="fa fa-check-circle" style="color:#2e7d32;" title="Available"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="slots-cards">
                            @foreach($slots as $slot)
                                <div class="slot-card">
                                    <div class="slot-card__date">{{ $slot->slot_datetime->format('l, M d, Y') }}</div>
                                    <div class="slot-card__row">
                                        <span>Time</span>
                                        <span>
                                            {{ $slot->slot_datetime->format('h:i A') }}
                                            &ndash;
                                            {{ $slot->slot_datetime->copy()->addMinutes((int) ($slot->availability->session_duration ?? 60))->format('h:i A') }}
                                        </span>
                                    </div>
                                    <div class="slot-card__row">
                                        <span>Status</span>
                                        <span>
                                            @if($slot->is_booked)
                                                <span class="fitnex-badge" style="background:rgba(198,40,40,0.12);color:#c62828;">Booked</span>
                                            @else
                                                <span class="fitnex-badge fitnex-badge--success">Available</span>
                                            @endif
                                        </span>
                                    </div>
                                    @if($slot->booking)
                                        <div class="slot-card__row">
                                            <span>Client</span>
                                            <span><a href="{{ route('trainer.bookings.show', $slot->booking->id) }}">{{ $slot->booking->user->name ?? 'Booking' }}</a></span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @if($slots->hasPages())
                            <div class="slots-pagination">
                                {{ $slots->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
(function () {
    if (sessionStorage.getItem('slotsFilterOpen') === '1') {
        var body = document.getElementById('slotsFilterBody');
        if (body) body.classList.remove('collapsed');
    }
    var toggle = document.querySelector('.slots-filter-toggle');
    if (toggle) {
        toggle.addEventListener('click', function () {
            var collapsed = document.getElementById('slotsFilterBody').classList.contains('collapsed');
            sessionStorage.setItem('slotsFilterOpen', collapsed ? '0' : '1');
        });
    }
})();
</script>
@endpush
