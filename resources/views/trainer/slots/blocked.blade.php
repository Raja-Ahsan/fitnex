@extends('layouts.trainer.app')

@section('title', 'Blocked Slots')

@push('css')
    @include('trainer.partials.theme-styles')
    <style>
        .blocked-card {
            border: 1px solid var(--fit-border, #e5eaf0);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 12px;
            background: #fff8e1;
            border-color: #ffe082;
        }
        .blocked-card__date {
            font-weight: 700;
            color: var(--fit-primary, #004274);
            font-size: 16px;
        }
        .blocked-card__row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-top: 6px;
            color: #5d4037;
        }
        @media (max-width: 767px) {
            .fitnex-table-desktop { display: none; }
            .blocked-cards { display: block; }
            .hero-actions { width: 100%; }
            .hero-actions .btn { flex: 1; }
        }
        @media (min-width: 768px) {
            .blocked-cards { display: none; }
        }
    </style>
@endpush

@section('content')
    <div class="content-header">
        <h1>
            Blocked Slots
            <small>Manage blocked periods</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('trainer.slots.index') }}">Slots</a></li>
            <li class="active">Blocked</li>
        </ol>
    </div>

    <section class="content">
        <div class="trainer-themed-page">
            <div class="fitnex-hero">
                <div>
                    <h1><i class="fa fa-calendar-times-o"></i> Blocked Periods</h1>
                    <p>{{ $blockedSlots->total() }} blocked range(s) on your schedule.</p>
                </div>
                <div class="hero-actions" style="display:flex;flex-wrap:wrap;gap:8px;">
                    <a href="{{ route('trainer.slots.index') }}" class="btn btn-hero">
                        <i class="fa fa-arrow-left"></i> All slots
                    </a>
                    <a href="{{ route('trainer.slots.block-form') }}" class="btn btn-hero" style="background:#fff8e1;color:#e65100;">
                        <i class="fa fa-ban"></i> Block new
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="fitnex-alert fitnex-alert--success" style="margin-bottom:16px;">
                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="fitnex-panel">
                <div class="fitnex-panel__body">
                    @if($blockedSlots->isEmpty())
                        <div class="fitnex-alert fitnex-alert--info text-center" style="padding:28px 20px;">
                            <i class="fa fa-check-circle fa-2x" style="display:block;margin-bottom:12px;color:#2e7d32;"></i>
                            <strong>No blocked time periods.</strong>
                            <p style="margin:10px 0 16px;">Your full availability is open unless you block specific times.</p>
                            <a href="{{ route('trainer.slots.block-form') }}" class="btn btn-fit-primary">
                                <i class="fa fa-ban"></i> Block time slots
                            </a>
                        </div>
                    @else
                        <div class="fitnex-table-wrap fitnex-table-desktop">
                            <table class="table fitnex-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time range</th>
                                        <th>Duration</th>
                                        <th>Reason</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blockedSlots as $blocked)
                                        @php
                                            $start = \Carbon\Carbon::parse($blocked->start_time);
                                            $end = \Carbon\Carbon::parse($blocked->end_time);
                                            $duration = $start->diffForHumans($end, true, false, 2);
                                        @endphp
                                        <tr>
                                            <td><strong>{{ \Carbon\Carbon::parse($blocked->date)->format('M d, Y') }}</strong></td>
                                            <td>
                                                {{ $start->format('h:i A') }} &ndash; {{ $end->format('h:i A') }}
                                            </td>
                                            <td><span class="fitnex-badge fitnex-badge--muted">{{ $duration }}</span></td>
                                            <td>{{ $blocked->reason ?? '—' }}</td>
                                            <td>
                                                <form action="{{ route('trainer.slots.unblock', $blocked->id) }}" method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Unblock this time period?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-fit-primary">
                                                        <i class="fa fa-check"></i> Unblock
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="blocked-cards">
                            @foreach($blockedSlots as $blocked)
                                @php
                                    $start = \Carbon\Carbon::parse($blocked->start_time);
                                    $end = \Carbon\Carbon::parse($blocked->end_time);
                                @endphp
                                <div class="blocked-card">
                                    <div class="blocked-card__date">{{ \Carbon\Carbon::parse($blocked->date)->format('l, M d, Y') }}</div>
                                    <div class="blocked-card__row">
                                        <span>Time</span>
                                        <span>{{ $start->format('h:i A') }} – {{ $end->format('h:i A') }}</span>
                                    </div>
                                    @if($blocked->reason)
                                        <div class="blocked-card__row">
                                            <span>Reason</span>
                                            <span>{{ $blocked->reason }}</span>
                                        </div>
                                    @endif
                                    <div class="fitnex-actions" style="margin-top:12px;">
                                        <form action="{{ route('trainer.slots.unblock', $blocked->id) }}" method="POST" style="flex:1;"
                                            onsubmit="return confirm('Unblock this time period?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-fit-primary" style="width:100%;">
                                                <i class="fa fa-check"></i> Unblock
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($blockedSlots->hasPages())
                            <div class="slots-pagination" style="text-align:center;padding-top:16px;">
                                {{ $blockedSlots->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
