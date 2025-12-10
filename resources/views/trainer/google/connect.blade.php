@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fab fa-google"></i> Google Calendar Integration</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($googleAccount && $googleAccount->is_connected)
                            <!-- Connected State -->
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> <strong>Connected!</strong> Your Google Calendar is
                                successfully connected.
                            </div>

                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h5>Connection Details</h5>
                                    <hr>
                                    <p><strong>Calendar ID:</strong> {{ $googleAccount->calendar_id }}</p>
                                    <p><strong>Connected On:</strong> {{ $googleAccount->created_at->format('M d, Y h:i A') }}
                                    </p>
                                    <p><strong>Last Updated:</strong> {{ $googleAccount->updated_at->format('M d, Y h:i A') }}
                                    </p>
                                    <p>
                                        <strong>Token Status:</strong>
                                        @if($googleAccount->isTokenExpired())
                                            <span class="badge bg-warning">Expired - Will refresh automatically</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <h6><i class="fas fa-info-circle"></i> What happens when connected?</h6>
                                <ul class="mb-0">
                                    <li>New bookings are automatically added to your Google Calendar</li>
                                    <li>Rescheduled bookings update the calendar event</li>
                                    <li>Cancelled bookings remove the calendar event</li>
                                    <li>Your availability is synced with your calendar</li>
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between">
                                <form action="{{ route('trainer.google.test') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-vial"></i> Test Connection
                                    </button>
                                </form>

                                <form action="{{ route('trainer.google.disconnect') }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to disconnect Google Calendar? Your bookings will no longer sync.');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-unlink"></i> Disconnect
                                    </button>
                                </form>
                            </div>
                        @else
                            <!-- Disconnected State -->
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> <strong>Not Connected</strong> - Connect your Google
                                Calendar to automatically sync your bookings.
                            </div>

                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h5>Benefits of Connecting Google Calendar</h5>
                                    <ul>
                                        <li><strong>Automatic Sync:</strong> All confirmed bookings are automatically added to
                                            your Google Calendar</li>
                                        <li><strong>Real-time Updates:</strong> Reschedules and cancellations are reflected
                                            instantly</li>
                                        <li><strong>Mobile Access:</strong> View your training schedule on any device with
                                            Google Calendar</li>
                                        <li><strong>Reminders:</strong> Get Google Calendar notifications for upcoming sessions
                                        </li>
                                        <li><strong>Avoid Double Booking:</strong> Your availability is checked against your
                                            calendar</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <h6><i class="fas fa-shield-alt"></i> Privacy & Security</h6>
                                <p class="mb-0">
                                    We only access your calendar to create and manage booking events.
                                    We never read your personal events or share your calendar data.
                                    You can disconnect at any time.
                                </p>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('trainer.google.connect') }}" class="btn btn-primary btn-lg">
                                    <i class="fab fa-google"></i> Connect Google Calendar
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection