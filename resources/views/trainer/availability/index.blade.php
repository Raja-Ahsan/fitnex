@extends('layouts.trainer.app')

@section('title', 'My Availability')

@push('css')
    @include('trainer.partials.theme-styles')
@endpush

@section('content')
    <div class="content-header">
        <h1>
            Availability
            <small>Weekly schedule for bookings</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Availability</li>
        </ol>
    </div>

    <section class="content">
        <div class="trainer-themed-page">
            <div class="fitnex-hero">
                <div>
                    <h1><i class="fa fa-calendar-check-o"></i> My Availability</h1>
                    <p>Set when clients can book sessions with you.</p>
                </div>
                <a href="{{ route('trainer.availability.create') }}" class="btn btn-hero">
                    <i class="fa fa-plus"></i> Add availability
                </a>
            </div>

            <div class="fitnex-panel">
                <div class="fitnex-panel__body">
                    @if(session('success'))
                        <div class="fitnex-alert fitnex-alert--success">
                            <i class="fa fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if($availabilities->isEmpty())
                        <div class="fitnex-alert fitnex-alert--info text-center" style="padding: 28px 20px;">
                            <i class="fa fa-info-circle fa-2x" style="display:block;margin-bottom:12px;opacity:0.8;"></i>
                            <strong>You haven't set up availability yet.</strong>
                            <p style="margin:10px 0 16px;">Add your weekly hours so booking slots can be generated.</p>
                            <a href="{{ route('trainer.availability.create') }}" class="btn btn-fit-primary">
                                <i class="fa fa-plus"></i> Add your first availability
                            </a>
                        </div>
                    @else
                        <div class="fitnex-table-wrap fitnex-table-desktop">
                            <table class="table fitnex-table">
                                <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Time</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($availabilities as $availability)
                                        <tr>
                                            <td><strong>{{ $availability->day_name }}</strong></td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }}
                                                &ndash;
                                                {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}
                                            </td>
                                            <td>
                                                <span class="fitnex-badge fitnex-badge--info">{{ $availability->session_duration }} min</span>
                                            </td>
                                            <td>
                                                @if($availability->is_active)
                                                    <span class="fitnex-badge fitnex-badge--success">Active</span>
                                                @else
                                                    <span class="fitnex-badge fitnex-badge--muted">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fitnex-actions">
                                                    <a href="{{ route('trainer.availability.edit', $availability->id) }}"
                                                        class="btn btn-sm btn-fit-warning">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('trainer.availability.destroy', $availability->id) }}"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Delete this availability?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-fit-danger">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="availability-cards">
                            @foreach($availabilities as $availability)
                                <div class="availability-card">
                                    <div class="availability-card__day">{{ $availability->day_name }}</div>
                                    <div class="availability-card__row">
                                        <span>Time</span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }}
                                            &ndash;
                                            {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}
                                        </span>
                                    </div>
                                    <div class="availability-card__row">
                                        <span>Duration</span>
                                        <span class="fitnex-badge fitnex-badge--info">{{ $availability->session_duration }} min</span>
                                    </div>
                                    <div class="availability-card__row">
                                        <span>Status</span>
                                        <span>
                                            @if($availability->is_active)
                                                <span class="fitnex-badge fitnex-badge--success">Active</span>
                                            @else
                                                <span class="fitnex-badge fitnex-badge--muted">Inactive</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="fitnex-actions">
                                        <a href="{{ route('trainer.availability.edit', $availability->id) }}"
                                            class="btn btn-sm btn-fit-warning">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('trainer.availability.destroy', $availability->id) }}"
                                            method="POST" style="flex:1;display:flex;"
                                            onsubmit="return confirm('Delete this availability?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-fit-danger" style="width:100%;">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
