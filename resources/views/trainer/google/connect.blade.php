@extends('layouts.trainer.app')

@section('title', 'Google Calendar')

@push('css')
    @include('trainer.partials.theme-styles')
    <style>
        .google-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .google-status-pill--connected {
            background: rgba(46, 125, 50, 0.12);
            color: #2e7d32;
        }
        .google-status-pill--disconnected {
            background: rgba(245, 124, 0, 0.12);
            color: #e65100;
        }
        .google-status-pill--unavailable {
            background: rgba(198, 40, 40, 0.1);
            color: #c62828;
        }
        .google-benefit-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin: 0 0 20px;
            padding: 0;
            list-style: none;
        }
        .google-benefit-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 14px;
            border-radius: 12px;
            background: var(--fit-bg, #f4f8fc);
            border: 1px solid var(--fit-border, #e5eaf0);
        }
        .google-benefit-item i {
            color: var(--fit-secondary, #0079d4);
            font-size: 18px;
            margin-top: 2px;
        }
        .google-benefit-item strong {
            display: block;
            color: var(--fit-primary, #004274);
            margin-bottom: 4px;
        }
        .google-benefit-item span {
            font-size: 13px;
            color: #4a5a6a;
            line-height: 1.45;
        }
        .google-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px 20px;
            margin-bottom: 16px;
        }
        .google-detail-item label {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--fit-muted, #6c7a88);
            margin-bottom: 4px;
        }
        .google-detail-item p {
            margin: 0;
            font-weight: 600;
            color: var(--fit-primary, #004274);
            word-break: break-word;
        }
        .google-privacy-box {
            padding: 16px 18px;
            border-radius: 12px;
            background: rgba(0, 121, 212, 0.08);
            border: 1px solid rgba(0, 121, 212, 0.2);
            margin-bottom: 20px;
        }
        .google-privacy-box h5 {
            margin: 0 0 8px;
            color: var(--fit-primary, #004274);
            font-weight: 700;
        }
        .google-privacy-box p {
            margin: 0;
            font-size: 13px;
            color: #4a5a6a;
            line-height: 1.5;
        }
        .google-cta-wrap {
            text-align: center;
            padding-top: 8px;
        }
        .google-cta-wrap .btn-connect {
            padding: 14px 28px;
            font-size: 16px;
            border-radius: 12px;
            font-weight: 700;
        }
        .google-note {
            margin-top: 12px;
            font-size: 12px;
            color: var(--fit-muted, #6c7a88);
        }
        .google-actions-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 8px;
        }
        .google-actions-row form {
            margin: 0;
        }
        @media (max-width: 767px) {
            .google-benefit-grid,
            .google-detail-grid {
                grid-template-columns: 1fr;
            }
            .google-actions-row .btn {
                flex: 1;
                min-width: calc(50% - 5px);
            }
            .google-actions-row form {
                flex: 1;
                min-width: calc(50% - 5px);
            }
            .google-actions-row form .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-header">
        <h1>
            Google Sync
            <small>Calendar integration</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Google Sync</li>
        </ol>
    </div>

    <section class="content">
        <div class="trainer-themed-page">
            <div class="fitnex-hero">
                <div>
                    <h1><i class="fa fa-google"></i> Google Calendar</h1>
                    <p>Sync your bookings with your personal Google Calendar.</p>
                </div>
                <div>
                    @if($googleAccount && $googleAccount->is_connected)
                        <span class="google-status-pill google-status-pill--connected" style="background:rgba(255,255,255,0.2);color:#fff;">
                            <i class="fa fa-check-circle"></i> Connected
                        </span>
                    @elseif(empty($googleConfigured))
                        <span class="google-status-pill google-status-pill--unavailable" style="background:rgba(255,255,255,0.15);color:#fff;">
                            <i class="fa fa-ban"></i> Unavailable
                        </span>
                    @else
                        <span class="google-status-pill google-status-pill--disconnected" style="background:rgba(255,255,255,0.15);color:#fff;">
                            <i class="fa fa-link"></i> Not connected
                        </span>
                    @endif
                </div>
            </div>

            <div class="fitnex-panel">
                <div class="fitnex-panel__body">
                    @if(session('success'))
                        <div class="fitnex-alert fitnex-alert--success">
                            <i class="fa fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if($googleAccount && $googleAccount->is_connected)
                        <div class="fitnex-alert fitnex-alert--success">
                            <i class="fa fa-check-circle"></i>
                            <strong>Your Google Calendar is connected.</strong>
                            New and updated bookings will sync to your calendar automatically.
                        </div>

                        <h5 style="color:#004274;font-weight:700;margin:0 0 14px;">Connection details</h5>
                        <div class="google-detail-grid">
                            <div class="google-detail-item">
                                <label>Calendar</label>
                                <p>{{ $googleAccount->calendar_id }}</p>
                            </div>
                            <div class="google-detail-item">
                                <label>Token status</label>
                                <p>
                                    @if($googleAccount->isTokenExpired())
                                        <span class="fitnex-badge fitnex-badge--muted">Refreshing when needed</span>
                                    @else
                                        <span class="fitnex-badge fitnex-badge--success">Active</span>
                                    @endif
                                </p>
                            </div>
                            <div class="google-detail-item">
                                <label>Connected on</label>
                                <p>{{ $googleAccount->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                            <div class="google-detail-item">
                                <label>Last updated</label>
                                <p>{{ $googleAccount->updated_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>

                        <div class="google-privacy-box">
                            <h5><i class="fa fa-refresh"></i> What syncs automatically</h5>
                            <p>New bookings are added, reschedules update events, and cancellations remove events from your calendar.</p>
                        </div>

                        <div class="google-actions-row">
                            <form action="{{ route('trainer.google.test') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-fit-primary">
                                    <i class="fa fa-plug"></i> Test connection
                                </button>
                            </form>
                            <form action="{{ route('trainer.google.disconnect') }}" method="POST"
                                onsubmit="return confirm('Disconnect Google Calendar? Future bookings will not sync until you connect again.');">
                                @csrf
                                <button type="submit" class="btn btn-fit-danger">
                                    <i class="fa fa-unlink"></i> Disconnect
                                </button>
                            </form>
                        </div>

                    @else
                        @if(empty($googleConfigured))
                            <div class="fitnex-alert fitnex-alert--info">
                                <i class="fa fa-info-circle"></i>
                                <strong>Calendar sync is not available yet.</strong>
                                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('Admin'))
                                    <p style="margin:10px 0 0;font-size:13px;">
                                        Admin: add <code>GOOGLE_CLIENT_ID</code>, <code>GOOGLE_CLIENT_SECRET</code>, and <code>GOOGLE_REDIRECT_URI</code> in <code>.env</code>, then run <code>php artisan config:clear</code>.
                                    </p>
                                @else
                                    <p style="margin:10px 0 0;font-size:13px;">
                                        Please contact FITNEX support. An administrator must enable Google Calendar on the website before you can connect your account.
                                    </p>
                                @endif
                            </div>
                        @else
                            <div class="fitnex-alert fitnex-alert--info" style="background:#fff8e1;color:#5d4037;">
                                <i class="fa fa-link"></i>
                                <strong>Not connected yet.</strong>
                                Connect your Google account to sync bookings with your calendar.
                            </div>
                        @endif

                        <h5 style="color:#004274;font-weight:700;margin:18px 0 12px;">Why connect?</h5>
                        <ul class="google-benefit-grid">
                            <li class="google-benefit-item">
                                <i class="fa fa-calendar-plus-o"></i>
                                <div>
                                    <strong>Automatic sync</strong>
                                    <span>Confirmed bookings appear on your Google Calendar.</span>
                                </div>
                            </li>
                            <li class="google-benefit-item">
                                <i class="fa fa-refresh"></i>
                                <div>
                                    <strong>Live updates</strong>
                                    <span>Reschedules and cancellations stay in sync.</span>
                                </div>
                            </li>
                            <li class="google-benefit-item">
                                <i class="fa fa-mobile"></i>
                                <div>
                                    <strong>Any device</strong>
                                    <span>View sessions on phone, tablet, or desktop.</span>
                                </div>
                            </li>
                            <li class="google-benefit-item">
                                <i class="fa fa-bell-o"></i>
                                <div>
                                    <strong>Reminders</strong>
                                    <span>Use Google’s notifications for upcoming sessions.</span>
                                </div>
                            </li>
                        </ul>

                        <div class="google-privacy-box">
                            <h5><i class="fa fa-shield"></i> Privacy &amp; security</h5>
                            <p>We only create and manage booking events on your calendar. We do not read personal events or share your data. You can disconnect anytime.</p>
                        </div>

                        <div class="google-cta-wrap">
                            @if(!empty($googleConfigured))
                                <a href="{{ route('trainer.google.connect') }}" class="btn btn-fit-primary btn-connect">
                                    <i class="fa fa-google"></i> Connect Google Calendar
                                </a>
                                <p class="google-note">You will sign in with your own Google account. Each trainer connects their own calendar.</p>
                            @else
                                <button type="button" class="btn btn-default btn-connect" disabled>
                                    <i class="fa fa-google"></i> Connect unavailable
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
