@extends('layouts.trainer.app')

@section('title', 'Block Time Slots')

@push('css')
    @include('trainer.partials.theme-styles')
@endpush

@section('content')
    <div class="content-header">
        <h1>
            Block Time Slots
            <small>Block a date and time range</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('trainer.slots.index') }}">Slots</a></li>
            <li class="active">Block</li>
        </ol>
    </div>

    <section class="content">
        <div class="trainer-themed-page">
            <div class="fitnex-hero">
                <div>
                    <h1><i class="fa fa-ban"></i> Block Time Slots</h1>
                    <p>Prevent new bookings during holidays or personal time.</p>
                </div>
            </div>

            <div class="fitnex-panel fitnex-form-card">
                <div class="fitnex-panel__body">
                    <form action="{{ route('trainer.slots.block') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="fitnex-alert" style="background:#ffebee;color:#c62828;margin-bottom:16px;">
                                <i class="fa fa-exclamation-circle"></i>
                                <ul style="margin:8px 0 0 18px;padding:0;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="fitnex-alert fitnex-alert--info" style="margin-bottom:18px;">
                            <i class="fa fa-info-circle"></i>
                            Block a time range so clients cannot book new sessions. Existing bookings in this range are <strong>not</strong> cancelled automatically.
                        </div>

                        <div class="form-group @error('date') has-error @enderror">
                            <label for="date" class="control-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required min="{{ date('Y-m-d') }}">
                            @error('date')<span class="help-block text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group @error('start_time') has-error @enderror">
                                    <label for="start_time" class="control-label">Start time <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                                    @error('start_time')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group @error('end_time') has-error @enderror">
                                    <label for="end_time" class="control-label">End time <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                                    @error('end_time')<span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group @error('reason') has-error @enderror">
                            <label for="reason" class="control-label">Reason (optional)</label>
                            <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="e.g. Vacation, personal appointment">{{ old('reason') }}</textarea>
                            @error('reason')<span class="help-block text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="google-privacy-box" style="background:#fff8e1;border-color:#ffe082;">
                            <h5 style="color:#e65100;"><i class="fa fa-warning"></i> Please note</h5>
                            <p style="color:#5d4037;">Unbooked slots in this range will be removed. Booked sessions stay on your calendar — cancel them from Bookings if needed.</p>
                        </div>

                        <div class="fitnex-form-footer">
                            <a href="{{ route('trainer.slots.index') }}" class="btn btn-fit-outline">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-fit-primary">
                                <i class="fa fa-ban"></i> Block slots
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
