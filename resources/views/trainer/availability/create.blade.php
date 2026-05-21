@extends('layouts.trainer.app')

@section('title', 'Add Availability')

@push('css')
    @include('trainer.partials.theme-styles')
@endpush

@section('content')
    <div class="content-header">
        <h1>
            Add Availability
            <small>Create a weekly time window</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('trainer.availability.index') }}">Availability</a></li>
            <li class="active">Add</li>
        </ol>
    </div>

    <section class="content">
        <div class="trainer-themed-page">
            <div class="fitnex-hero">
                <div>
                    <h1><i class="fa fa-plus-circle"></i> Add Availability</h1>
                    <p>Choose a day, time range, and session length.</p>
                </div>
            </div>

            <div class="fitnex-panel fitnex-form-card">
                <div class="fitnex-panel__body">
                    <form action="{{ route('trainer.availability.store') }}" method="POST" class="fitnex-form-card">
                        @csrf

                        <div class="form-group">
                            <label for="day_of_week" class="control-label">Day of week <span class="text-danger">*</span></label>
                            <select name="day_of_week" id="day_of_week"
                                class="form-control @error('day_of_week') is-invalid @enderror" required>
                                <option value="">Select a day</option>
                                @foreach($days as $value => $name)
                                    <option value="{{ $value }}" {{ old('day_of_week') == $value ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('day_of_week')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="start_time" class="control-label">Start time <span class="text-danger">*</span></label>
                                    <input type="time" name="start_time" id="start_time"
                                        class="form-control @error('start_time') is-invalid @enderror"
                                        value="{{ old('start_time') }}" required>
                                    @error('start_time')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="end_time" class="control-label">End time <span class="text-danger">*</span></label>
                                    <input type="time" name="end_time" id="end_time"
                                        class="form-control @error('end_time') is-invalid @enderror"
                                        value="{{ old('end_time') }}" required>
                                    @error('end_time')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="session_duration" class="control-label">Session duration <span class="text-danger">*</span></label>
                            <select name="session_duration" id="session_duration"
                                class="form-control @error('session_duration') is-invalid @enderror" required>
                                <option value="">Select duration</option>
                                <option value="30" {{ old('session_duration') == '30' ? 'selected' : '' }}>30 minutes</option>
                                <option value="45" {{ old('session_duration') == '45' ? 'selected' : '' }}>45 minutes</option>
                                <option value="60" {{ old('session_duration') == '60' ? 'selected' : '' }}>60 minutes</option>
                            </select>
                            @error('session_duration')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                            <p class="fitnex-form-hint">
                                <i class="fa fa-lightbulb-o"></i> Slots are generated automatically from this duration.
                            </p>
                        </div>

                        <div class="form-group fitnex-check">
                            <label class="checkbox-inline" style="padding-left:22;">
                                <input type="checkbox" name="is_active" id="is_active" value="1"
                                    {{ old('is_active', true) ? 'checked' : '' }}>
                                Active &mdash; generate bookable slots for this window
                            </label>
                        </div>

                        <div class="fitnex-form-footer">
                            <a href="{{ route('trainer.availability.index') }}" class="btn btn-fit-outline">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-fit-primary">
                                <i class="fa fa-save"></i> Save availability
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
(function () {
    var start = document.getElementById('start_time');
    var end = document.getElementById('end_time');
    if (start && end) {
        end.addEventListener('change', function () {
            if (start.value && end.value && end.value <= start.value) {
                end.setCustomValidity('End time must be after start time.');
            } else {
                end.setCustomValidity('');
            }
        });
    }
})();
</script>
@endpush
