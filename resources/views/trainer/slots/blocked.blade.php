@extends('layouts.trainer.app')

@section('content')
    <div class="content-header">
        <h1>
            Blocked Time Slots
            <small>Manage your blocked periods</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('trainer.slots.index') }}">Slots</a></li>
            <li class="active">Blocked Slots</li>
        </ol>
    </div>

    <section class="content">
        <div class="row mb-3">
            <div class="col-md-12 text-right" style="margin-bottom: 15px;">
                <a href="{{ route('trainer.slots.index') }}" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i> Back to Slots
                </a>
                <a href="{{ route('trainer.slots.block-form') }}" class="btn btn-primary"
                    style="background-color: #004b85; border-color: #004b85;">
                    <i class="fa fa-ban"></i> Block New Slots
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" style="border-top-color: #004b85;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blocked Periods</h3>
                        <div class="box-tools pull-right">
                            <span class="label label-primary">{{ $blockedSlots->total() }} total</span>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        @if($blockedSlots->isEmpty())
                            <div class="alert alert-info" style="margin: 20px;">
                                <i class="icon fa fa-info"></i> You haven't blocked any time slots yet.
                            </div>
                        @else
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time Range</th>
                                        <th>Duration</th>
                                        <th>Reason</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blockedSlots as $blocked)
                                        <tr>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($blocked->date)->format('M d, Y') }}</strong>
                                            </td>
                                            <td>
                                                <i class="fa fa-clock-o text-muted"></i>
                                                {{ \Carbon\Carbon::parse($blocked->start_time)->format('h:i A') }} -
                                                {{ \Carbon\Carbon::parse($blocked->end_time)->format('h:i A') }}
                                            </td>
                                            <td>
                                                @php
                                                    $start = \Carbon\Carbon::parse($blocked->start_time);
                                                    $end = \Carbon\Carbon::parse($blocked->end_time);
                                                    $duration = $start->diffInHours($end) . ' hours';
                                                    if ($start->diffInMinutes($end) % 60 > 0) {
                                                        $duration = $start->diffForHumans($end, true);
                                                    }
                                                @endphp
                                                {{ $duration }}
                                            </td>
                                            <td>{{ $blocked->reason ?? '-' }}</td>
                                            <td>
                                                <form action="{{ route('trainer.slots.unblock', $blocked->id) }}" method="POST"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Are you sure you want to unblock this time period?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-success" title="Unblock">
                                                        <i class="fa fa-check"></i> Unblock
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    @if($blockedSlots->hasPages())
                        <div class="box-footer clearfix">
                            {{ $blockedSlots->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection