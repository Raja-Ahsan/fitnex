@extends('layouts.admin.app')

@section('title', $page_title)

@section('content')
<section class="content-header">
    <h1>{{ $page_title }}</h1>
</section>

<section class="content">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Availability</span>
                    <span class="info-box-number">{{ $stats['total_availabilities'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active</span>
                    <span class="info-box-number">{{ $stats['active_availabilities'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-ban"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Inactive</span>
                    <span class="info-box-number">{{ $stats['inactive_availabilities'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-blue">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Trainers with Availability</span>
                    <span class="info-box-number">{{ $stats['trainers_with_availability'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Filter Availability</h3>
        </div>
        <div class="box-body">
            <form method="GET" action="{{ route('admin.availability.index') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="trainer_id">Trainer</label>
                            <select name="trainer_id" id="trainer_id" class="form-control">
                                <option value="">All Trainers</option>
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}" {{ request('trainer_id') == $trainer->id ? 'selected' : '' }}>
                                        {{ $trainer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="day_of_week">Day of Week</label>
                            <select name="day_of_week" id="day_of_week" class="form-control">
                                <option value="">All Days</option>
                                @foreach($days as $key => $day)
                                    <option value="{{ $key }}" {{ request('day_of_week') == $key ? 'selected' : '' }}>
                                        {{ $day }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-top: 25px;">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Availability Table -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Availability</h3>
            <div class="box-tools pull-right">
                <span class="label label-primary">{{ $availabilities->total() }} Total</span>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if($availabilities->isEmpty())
                <div class="alert alert-info">
                    <i class="fa fa-info"></i> No availability found.
                </div>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trainer</th>
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
                                <td>#{{ $availability->id }}</td>
                                <td>
                                    <strong>{{ $availability->trainer->name ?? 'N/A' }}</strong>
                                </td>
                                <td>
                                    {{ $days[$availability->day_of_week] ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }} - 
                                    {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}
                                </td>
                                <td>
                                    {{ $availability->session_duration }} minutes
                                </td>
                                <td>
                                    @if($availability->is_active)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.availability.show', $availability->trainer_id) }}" class="btn btn-xs btn-info">
                                        <i class="fa fa-eye"></i> View Trainer
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $availabilities->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

