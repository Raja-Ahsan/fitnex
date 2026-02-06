@extends('layouts.trainer.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>My Availability Schedule</h4>
                        <a href="{{ route('trainer.availability.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Availability
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($availabilities->isEmpty())
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> You haven't set up your availability yet.
                                <a href="{{ route('trainer.availability.create') }}">Add your first availability</a> to start
                                accepting bookings.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Time Range</th>
                                            <th>Session Duration</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($availabilities as $availability)
                                            <tr>
                                                <td>
                                                    <strong>{{ $availability->day_name }}</strong>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }} -
                                                    {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $availability->session_duration }} minutes</span>
                                                </td>
                                                <td>
                                                    @if($availability->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('trainer.availability.edit', $availability->id) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form
                                                            action="{{ route('trainer.availability.destroy', $availability->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Are you sure you want to delete this availability?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection