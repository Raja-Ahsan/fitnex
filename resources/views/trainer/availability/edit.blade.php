@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Availability</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('trainer.availability.update', $availability->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="day_of_week" class="form-label">Day of Week <span
                                        class="text-danger">*</span></label>
                                <select name="day_of_week" id="day_of_week"
                                    class="form-select @error('day_of_week') is-invalid @enderror" required>
                                    <option value="">Select a day</option>
                                    @foreach($days as $value => $name)
                                        <option value="{{ $value }}" {{ old('day_of_week', $availability->day_of_week) == $value ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('day_of_week')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_time" class="form-label">Start Time <span
                                            class="text-danger">*</span></label>
                                    <input type="time" name="start_time" id="start_time"
                                        class="form-control @error('start_time') is-invalid @enderror"
                                        value="{{ old('start_time', $availability->start_time) }}" required>
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="end_time" class="form-label">End Time <span
                                            class="text-danger">*</span></label>
                                    <input type="time" name="end_time" id="end_time"
                                        class="form-control @error('end_time') is-invalid @enderror"
                                        value="{{ old('end_time', $availability->end_time) }}" required>
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="session_duration" class="form-label">Session Duration <span
                                        class="text-danger">*</span></label>
                                <select name="session_duration" id="session_duration"
                                    class="form-select @error('session_duration') is-invalid @enderror" required>
                                    <option value="">Select duration</option>
                                    <option value="30" {{ old('session_duration', $availability->session_duration) == '30' ? 'selected' : '' }}>30 minutes</option>
                                    <option value="45" {{ old('session_duration', $availability->session_duration) == '45' ? 'selected' : '' }}>45 minutes</option>
                                    <option value="60" {{ old('session_duration', $availability->session_duration) == '60' ? 'selected' : '' }}>60 minutes</option>
                                </select>
                                @error('session_duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Changing duration will regenerate all future slots.
                                </small>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                                        value="1" {{ old('is_active', $availability->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active (slots will be generated for this availability)
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('trainer.availability.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Availability
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection