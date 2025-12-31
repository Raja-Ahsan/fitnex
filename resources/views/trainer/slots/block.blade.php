@extends('layouts.trainer.app')

@section('content')
    <div class="content-header">
        <h1>
            Block Time Slots
            <small>Manage your availability</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('trainer.slots.index') }}">Slots</a></li>
            <li class="active">Block Slots</li>
        </ol>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="{{ route('trainer.slots.block') }}" method="POST">
                    @csrf
                    <div class="box box-primary" style="border-top-color: #004b85;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Block a Time Range</h3>
                        </div>
                        <div class="box-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-info"></i> Note</h4>
                                Block specific time ranges (e.g., for holidays, personal time). This will prevent new
                                bookings during these times.
                            </div>

                            <div class="form-group @error('date') has-error @enderror">
                                <label for="date">Date <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}"
                                        required min="{{ date('Y-m-d') }}">
                                </div>
                                @error('date')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('start_time') has-error @enderror">
                                        <label for="start_time">Start Time <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="time" class="form-control" id="start_time" name="start_time"
                                                value="{{ old('start_time') }}" required>
                                        </div>
                                        @error('start_time')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('end_time') has-error @enderror">
                                        <label for="end_time">End Time <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="time" class="form-control" id="end_time" name="end_time"
                                                value="{{ old('end_time') }}" required>
                                        </div>
                                        @error('end_time')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group @error('reason') has-error @enderror">
                                <label for="reason">Reason (Optional)</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3"
                                    placeholder="e.g., Vacation, Doctor's Appointment">{{ old('reason') }}</textarea>
                                @error('reason')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="callout callout-warning">
                                <h4>Warning!</h4>
                                <p>Blocking slots will only prevent NEW bookings. Existing bookings in this range will NOT
                                    be cancelled automatically.</p>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('trainer.slots.index') }}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right"
                                style="background-color: #004b85; border-color: #004b85;">
                                <i class="fa fa-ban"></i> Block Slots
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection