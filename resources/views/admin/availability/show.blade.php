@extends('layouts.admin.app')

@section('title', $page_title)

@section('content')
<section class="content-header">
    <h1>{{ $page_title }}</h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Availability for {{ $trainer->name }}</h3>
        </div>
        <div class="box-body">
            @if($availabilities->isEmpty())
                <div class="alert alert-info">
                    <i class="fa fa-info"></i> No availability set for this trainer.
                </div>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Duration</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availabilities as $availability)
                            <tr>
                                <td>{{ $days[$availability->day_of_week] ?? 'N/A' }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }} - 
                                    {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}
                                </td>
                                <td>{{ $availability->session_duration }} minutes</td>
                                <td>
                                    @if($availability->is_active)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('admin.availability.index') }}" class="btn btn-default">
                        <i class="fa fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

