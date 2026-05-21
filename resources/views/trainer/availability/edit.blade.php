@extends('layouts.trainer.app')

@section('title', 'Edit Availability')

@push('css')
    @include('trainer.partials.theme-styles')
@endpush

@section('content')
    <div class="content-header">
        <h1>
            Edit Availability
            <small>Update your weekly time window</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('trainer.availability.index') }}">Availability</a></li>
            <li class="active">Edit</li>
        </ol>
    </div>

    <section class="content">
        <div class="trainer-themed-page">
            <div class="fitnex-hero">
                <div>
                    <h1><i class="fa fa-pencil-square-o"></i> Edit Availability</h1>
                    <p>Updating <strong>{{ $availability->day_name }}</strong> &mdash; future slots may regenerate if duration changes.</p>
                </div>
            </div>

            <div class="fitnex-panel fitnex-form-card">
                <div class="fitnex-panel__body">
                    <form action="{{ route('trainer.availability.update', $availability->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="day_of_week" class="control-label">Day of week <span class="text-danger">*</span></label>
                            <select name="day_of_week" id="day_of_week"
                                class="form-control @error('day_of_week') is-invalid @enderror" required>
                                <option value="">Select a day</option>
                                @foreach($days as $value => $name)
                                    <option value="{{ $value }}" {{ old('day_of_week', $availability->day_of_week) == $value ? 'selected' : '' }}>
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
                                    @php
                                        $startVal = old('start_time', $availability->start_time);
                                        if ($startVal && strlen($startVal) > 5) {
                                            $startVal = \Carbon\Carbon::parse($startVal)->format('H:i');
                                        }
                                    @endphp
                                    <input type="time" name="start_time" id="start_time"
                                        class="form-control @error('start_time') is-invalid @enderror"
                                        value="{{ $startVal }}" required>
                                    @error('start_time')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="end_time" class="control-label">End time <span class="text-danger">*</span></label>
                                    @php
                                        $endVal = old('end_time', $availability->end_time);
                                        if ($endVal && strlen($endVal) > 5) {
                                            $endVal = \Carbon\Carbon::parse($endVal)->format('H:i');
                                        }
                                    @endphp
                                    <input type="time" name="end_time" id="end_time"
                                        class="form-control @error('end_time') is-invalid @enderror"
                                        value="{{ $endVal }}" required>
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
                                <option value="30" {{ old('session_duration', $availability->session_duration) == '30' ? 'selected' : '' }}>30 minutes</option>
                                <option value="45" {{ old('session_duration', $availability->session_duration) == '45' ? 'selected' : '' }}>45 minutes</option>
                                <option value="60" {{ old('session_duration', $availability->session_duration) == '60' ? 'selected' : '' }}>60 minutes</option>
                            </select>
                            @error('session_duration')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                            <p class="fitnex-form-hint">
                                <i class="fa fa-exclamation-circle"></i> Changing duration will regenerate future slots.
                            </p>
                        </div>

                        <div class="form-group fitnex-check">
                            <label class="checkbox-inline" style="padding-left:0;">
                                <input type="checkbox" name="is_active" id="is_active" value="1"
                                    {{ old('is_active', $availability->is_active) ? 'checked' : '' }}>
                                Active &mdash; generate bookable slots for this window
                            </label>
                        </div>

                        <div class="fitnex-form-footer">
                            <a href="{{ route('trainer.availability.index') }}" class="btn btn-fit-outline">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-fit-primary">
                                <i class="fa fa-save"></i> Update availability
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
        function validateRange() {
            if (start.value && end.value && end.value <= start.value) {
                end.setCustomValidity('End time must be after start time.');
            } else {
                end.setCustomValidity('');
            }
        }
        start.addEventListener('change', validateRange);
        end.addEventListener('change', validateRange);
    }
})();
</script>
@endpush
