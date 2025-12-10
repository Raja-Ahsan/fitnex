@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Block Time Slots</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('trainer.slots.block') }}" method="POST">
                            @csrf

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Block time slots to prevent customers from booking during
                                specific periods (e.g., vacation, personal time).
                            </div>

                            <div class="mb-3">
                                <label for="start_datetime" class="form-label">Start Date & Time <span
                                        class="text-danger">*</span></label>
                                <input type="datetime-local"
                                    class="form-control @error('start_datetime') is-invalid @enderror" id="start_datetime"
                                    name="start_datetime" value="{{ old('start_datetime') }}" required>
                                @error('start_datetime')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="end_datetime" class="form-label">End Date & Time <span
                                        class="text-danger">*</span></label>
                                <input type="datetime-local"
                                    class="form-control @error('end_datetime') is-invalid @enderror" id="end_datetime"
                                    name="end_datetime" value="{{ old('end_datetime') }}" required>
                                @error('end_datetime')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason (Optional)</label>
                                <textarea class="form-control @error('reason') is-invalid @enderror" id="reason"
                                    name="reason" rows="3"
                                    placeholder="e.g., Vacation, Personal appointment">{{ old('reason') }}</textarea>
                                @error('reason')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="alert alert-warning">
                                <strong>Note:</strong> Existing bookings in this time range will NOT be cancelled. Only new
                                bookings will be prevented.
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('trainer.slots.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-ban"></i> Block Slots
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection