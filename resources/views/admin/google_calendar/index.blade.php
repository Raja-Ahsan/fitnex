@extends('layouts.admin.app')

@section('title', $page_title)

@push('css')
<style>
    .gc-settings__head { display: flex; align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap; }
    .gc-source { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 999px; background: var(--admin-bg); border: 1px solid var(--admin-border); font-size: 11px; font-weight: 600; color: #5b6875; }
    .gc-section-label { font-size: 11px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: #95a2af; margin: 4px 0 10px; }
    .gc-section-label:not(:first-child) { margin-top: 22px; padding-top: 18px; border-top: 1px dashed var(--admin-border); }
    .gc-fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px 22px; }
    .gc-field label { display: block; font-size: 13px; font-weight: 600; color: #1b2b3c; margin-bottom: 6px; }
    .gc-optional { display: inline-block; margin-left: 6px; padding: 1px 7px; border-radius: 999px; background: var(--admin-bg); font-size: 10px; font-weight: 600; color: #95a2af; vertical-align: middle; }
    .gc-input { position: relative; display: flex; align-items: center; background: #fff; border: 1px solid var(--admin-border); border-radius: 10px; transition: border-color .15s, box-shadow .15s; }
    .gc-input:focus-within { border-color: var(--admin-secondary); box-shadow: 0 0 0 3px rgba(11, 111, 214, .12); }
    .gc-input > i { width: 40px; text-align: center; color: #95a2af; font-size: 14px; flex-shrink: 0; }
    .gc-input input { flex: 1; min-width: 0; height: 42px; border: none; outline: none; background: transparent; padding: 0 12px 0 0; font-size: 13px; color: #1b2b3c; }
    .gc-input__toggle { border: none; background: transparent; width: 40px; height: 40px; color: #95a2af; cursor: pointer; flex-shrink: 0; }
    .gc-input__toggle:hover { color: var(--admin-primary); }
    .gc-error { font-size: 12px; color: #c62828; margin-top: 4px; }
    .gc-settings__foot { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; padding: 14px 20px; background: var(--admin-bg); border-top: 1px solid var(--admin-border); }
    .gc-stats { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 16px; }
    .gc-stat { flex: 1; min-width: 140px; background: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: 10px; padding: 12px 14px; }
    .gc-stat strong { display: block; font-size: 22px; color: var(--admin-primary); }
    .gc-stat span { font-size: 12px; color: #6c7a88; }
    .gc-status { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; }
    .gc-status--ok { background: rgba(46, 125, 50, 0.12); color: #2e7d32; }
    .gc-status--off { background: rgba(198, 40, 40, 0.12); color: #c62828; }
    .gc-help { font-size: 12px; color: #6c7a88; margin-top: 4px; }
    .gc-tabs { display: flex; gap: 6px; flex-wrap: wrap; }
    .gc-tabs a { padding: 6px 12px; border-radius: 999px; border: 1px solid var(--admin-border); font-size: 12px; color: var(--admin-primary); }
    .gc-tabs a.active { background: var(--admin-secondary); border-color: var(--admin-secondary); color: #fff; }
    .gc-swal-popup { border-radius: 16px !important; padding-bottom: 22px !important; }
    .gc-swal-popup .swal2-title { font-size: 22px; color: var(--admin-primary); }
    .gc-swal-popup .swal2-html-container { font-size: 14px; color: #5b6875; line-height: 1.55; }
    .gc-swal-popup .swal2-actions button { border-radius: 999px !important; padding: 9px 22px !important; font-weight: 600; }
    .gc-swal-icon { border: none !important; background: rgba(13, 59, 102, 0.1); color: var(--admin-primary) !important; font-size: 26px; }
    .gc-swal-icon--danger { background: rgba(211, 51, 51, 0.1); color: #d33 !important; }
    .gc-central { display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
    .gc-central__info { display: flex; align-items: flex-start; gap: 14px; flex: 1; min-width: 260px; }
    .gc-central__icon { flex: 0 0 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: var(--admin-bg); color: #95a2af; font-size: 20px; }
    .gc-central__icon.is-on { background: rgba(219, 68, 55, 0.1); color: #db4437; }
    .gc-central__title { font-size: 14px; color: #1b2b3c; }
    .gc-central__actions { display: flex; gap: 8px; flex-wrap: wrap; }
    @media (max-width: 767px) {
        .gc-fields { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<section class="content">
    <div class="admin-themed-page">
        <div class="admin-hero">
            <div>
                <h1><i class="fa-brands fa-google"></i> {{ $page_title }}</h1>
                <p>Set up Google sign-in once, then see which trainers have synced their calendars.</p>
            </div>
            @if($configured)
                <span class="gc-status gc-status--ok"><i class="fa fa-check-circle"></i> Ready — trainers can connect</span>
            @else
                <span class="gc-status gc-status--off"><i class="fa fa-times-circle"></i> Not set up yet</span>
            @endif
        </div>

        <div class="admin-panel gc-settings">
            <div class="admin-panel__head gc-settings__head">
                <span><i class="fa fa-key"></i> Google OAuth settings</span>
                <span class="gc-source">
                    @if($settings['source'] === 'dashboard')
                        <i class="fa fa-database"></i> Saved in dashboard
                    @elseif($settings['source'] === 'env')
                        <i class="fa fa-server"></i> Using server .env values
                    @else
                        <i class="fa fa-circle-exclamation"></i> Not configured
                    @endif
                </span>
            </div>

            <form action="{{ route('admin.google-calendar.settings') }}" method="POST" autocomplete="off">
                @csrf
                <div class="admin-panel__body">
                    <div class="gc-section-label">Credentials</div>
                    <div class="gc-fields">
                        <div class="gc-field">
                            <label for="google_client_id">Client ID <span class="text-danger">*</span></label>
                            <div class="gc-input">
                                <i class="fa fa-id-card"></i>
                                <input type="text" id="google_client_id" name="google_client_id"
                                    value="{{ old('google_client_id', $settings['client_id']) }}"
                                    placeholder="xxxxxxxx.apps.googleusercontent.com" required>
                            </div>
                            @error('google_client_id')<div class="gc-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="gc-field">
                            <label for="google_client_secret">Client Secret @if(!$settings['secret_mask'])<span class="text-danger">*</span>@endif</label>
                            <div class="gc-input">
                                <i class="fa fa-lock"></i>
                                <input type="password" id="google_client_secret" name="google_client_secret"
                                    placeholder="{{ $settings['secret_mask'] ? 'Saved (' . $settings['secret_mask'] . ')' : 'GOCSPX-...' }}"
                                    autocomplete="new-password">
                                <button type="button" class="gc-input__toggle" data-toggle-secret="google_client_secret" aria-label="Show secret">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <div class="gc-help">Stored encrypted. Leave blank to keep the saved secret.</div>
                            @error('google_client_secret')<div class="gc-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="gc-section-label">Redirect URIs</div>
                    <div class="gc-fields">
                        <div class="gc-field">
                            <label for="google_redirect_uri">Calendar redirect URI <span class="text-danger">*</span></label>
                            <div class="gc-input">
                                <i class="fa-solid fa-calendar-check"></i>
                                <input type="url" id="google_redirect_uri" name="google_redirect_uri"
                                    value="{{ old('google_redirect_uri', $settings['redirect_uri']) }}" required>
                            </div>
                            <div class="gc-help">Must match an authorized redirect URI in Google Cloud Console.</div>
                            @error('google_redirect_uri')<div class="gc-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="gc-field">
                            <label for="google_login_redirect_uri">Login redirect URI <span class="gc-optional">Optional</span></label>
                            <div class="gc-input">
                                <i class="fa fa-right-to-bracket"></i>
                                <input type="url" id="google_login_redirect_uri" name="google_login_redirect_uri"
                                    value="{{ old('google_login_redirect_uri', $settings['login_redirect_uri']) }}">
                            </div>
                            <div class="gc-help">Used by "Sign in with Google" on the login page.</div>
                            @error('google_login_redirect_uri')<div class="gc-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="gc-settings__foot">
                    <span class="gc-help" style="margin:0;">
                        @if($settings['source'] === 'env')
                            <i class="fa fa-info-circle"></i> Saving here overrides the values in the server .env file.
                        @else
                            <i class="fa fa-shield-halved"></i> Changes apply immediately — no server restart needed.
                        @endif
                    </span>
                    <button type="submit" class="btn btn-admin-primary"><i class="fa fa-save"></i> Save settings</button>
                </div>
            </form>
        </div>

        <div class="admin-panel" style="border-top:1px solid var(--admin-border) !important;">
            <div class="admin-panel__head"><i class="fa-solid fa-calendar-days"></i> FITNEX central calendar</div>
            <div class="admin-panel__body">
                <div class="gc-central">
                    <div class="gc-central__info">
                        <span class="gc-central__icon {{ $centralConnected ? 'is-on' : '' }}"><i class="fa-brands fa-google"></i></span>
                        <div>
                            @if($centralConnected)
                                <div class="gc-central__title">
                                    Connected to <strong>{{ $central->google_email ?: $central->calendar_id }}</strong>
                                    <span class="admin-badge admin-badge--success" style="margin-left:6px;"><i class="fa fa-check"></i> Active</span>
                                </div>
                                <div class="gc-help" style="margin-top:4px;">
                                    Every booking from every trainer is copied to this calendar, including confirmations, reschedules and cancellations.
                                    {{ $centralSyncedCount }} booking(s) currently in the calendar.
                                    @if($central->updated_at) Connected {{ $central->updated_at->diffForHumans() }}. @endif
                                </div>
                            @else
                                <div class="gc-central__title">Not connected</div>
                                <div class="gc-help" style="margin-top:4px;">
                                    Connect the FITNEX owner's Google account (e.g. <strong>{{ config('google-calendar.calendar_id') ?: 'joinfitnex@gmail.com' }}</strong>)
                                    to see all trainers' bookings in one calendar. Each trainer still gets the booking in their own calendar too.
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="gc-central__actions">
                        @if($centralConnected)
                            <form action="{{ route('admin.google-calendar.central.sync') }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-admin-primary"><i class="fa fa-rotate"></i> Sync upcoming bookings</button>
                            </form>
                            <form action="{{ route('admin.google-calendar.central.test') }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-plug"></i> Test</button>
                            </form>
                            <form action="{{ route('admin.google-calendar.central.disconnect') }}" method="POST" style="margin:0;" class="gc-confirm"
                                data-title="Disconnect FITNEX calendar?"
                                data-text="New bookings will stop appearing in this Google Calendar. Events already added will stay there."
                                data-confirm="Yes, disconnect"
                                data-icon="fa fa-unlink"
                                data-confirm-icon="fa fa-unlink"
                                data-danger="1">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-default text-danger"><i class="fa fa-unlink"></i> Disconnect</button>
                            </form>
                        @elseif($configured)
                            <a href="{{ route('admin.google-calendar.central.connect') }}" class="btn btn-admin-primary">
                                <i class="fa-brands fa-google"></i> Connect FITNEX calendar
                            </a>
                        @else
                            <span class="gc-help">Save the Google OAuth settings above first.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-panel" style="border-top:1px solid var(--admin-border) !important;">
            <div class="admin-panel__head" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
                <span><i class="fa fa-users"></i> Trainer calendar status</span>
                @if($configured && $connectedCount < $totalCount)
                    <form action="{{ route('admin.google-calendar.remind-all') }}" method="POST" style="margin:0;" class="gc-confirm"
                        data-title="Send reminders to all?"
                        data-text="Every active trainer who hasn't connected Google Calendar will get an email with a connect link."
                        data-confirm="Yes, send emails">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-admin-primary"><i class="fa fa-envelope"></i> Remind all not connected</button>
                    </form>
                @endif
            </div>
            <div class="admin-panel__body">
                <div class="gc-stats">
                    <div class="gc-stat"><strong>{{ $connectedCount }}</strong><span>Connected</span></div>
                    <div class="gc-stat"><strong>{{ $totalCount - $connectedCount }}</strong><span>Not connected</span></div>
                    <div class="gc-stat"><strong>{{ $totalCount }}</strong><span>Total trainers</span></div>
                </div>

                <div class="gc-tabs" style="margin-bottom:14px;">
                    <a href="{{ route('admin.google-calendar.index') }}" class="{{ $filter === 'all' ? 'active' : '' }}">All</a>
                    <a href="{{ route('admin.google-calendar.index', ['filter' => 'connected']) }}" class="{{ $filter === 'connected' ? 'active' : '' }}">Connected</a>
                    <a href="{{ route('admin.google-calendar.index', ['filter' => 'not_connected']) }}" class="{{ $filter === 'not_connected' ? 'active' : '' }}">Not connected</a>
                </div>

                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Trainer</th>
                                <th>Email</th>
                                <th>Listing</th>
                                <th>Google Calendar</th>
                                <th>Calendar</th>
                                <th>Connected on</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trainers as $trainer)
                                @php
                                    $account = $trainer->googleAccount;
                                    $connected = $account && $account->is_connected;
                                @endphp
                                <tr>
                                    <td><strong>{{ trim(($trainer->user->name ?? '') . ' ' . ($trainer->user->last_name ?? '')) ?: '—' }}</strong></td>
                                    <td>{{ $trainer->user->email ?? '—' }}</td>
                                    <td>
                                        @if($trainer->status)
                                            <span class="admin-badge admin-badge--success">Active</span>
                                        @else
                                            <span class="admin-badge admin-badge--danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($connected)
                                            <span class="admin-badge admin-badge--success"><i class="fa fa-check"></i> Connected</span>
                                        @else
                                            <span class="admin-badge admin-badge--danger"><i class="fa fa-times"></i> Not connected</span>
                                        @endif
                                    </td>
                                    <td class="admin-truncate" title="{{ $connected ? $account->calendar_id : '' }}">{{ $connected ? $account->calendar_id : '—' }}</td>
                                    <td>{{ $connected && $account->updated_at ? $account->updated_at->format('M d, Y') : '—' }}</td>
                                    <td>
                                        @if(!$connected && $trainer->user?->email)
                                            <form action="{{ route('admin.google-calendar.remind', $trainer->id) }}" method="POST" style="margin:0;" class="gc-confirm"
                                                data-title="Send reminder?"
                                                data-text="{{ trim(($trainer->user->name ?? '') . ' ' . ($trainer->user->last_name ?? '')) ?: 'This trainer' }} will get an email at {{ $trainer->user->email }} asking them to connect Google Calendar."
                                                data-confirm="Yes, send it">
                                                @csrf
                                                <button type="submit" class="btn btn-xs btn-admin-primary" @disabled(!$configured)
                                                    title="{{ $configured ? 'Email this trainer a connect link' : 'Save Google settings first' }}">
                                                    <i class="fa fa-envelope"></i> Send reminder
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center text-muted" style="padding:24px;">No trainers in this list.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
document.querySelectorAll('[data-toggle-secret]').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var input = document.getElementById(btn.getAttribute('data-toggle-secret'));
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.querySelector('i').className = show ? 'fa fa-eye-slash' : 'fa fa-eye';
    });
});

document.querySelectorAll('form.gc-confirm').forEach(function (form) {
    form.addEventListener('submit', function (e) {
        if (form.dataset.confirmed === '1' || !window.Swal) { return; }
        e.preventDefault();

        var primary = getComputedStyle(document.documentElement).getPropertyValue('--admin-primary').trim() || '#0d3b66';

        Swal.fire({
            title: form.dataset.title,
            text: form.dataset.text,
            iconHtml: '<i class="' + (form.dataset.icon || 'fa fa-envelope') + '"></i>',
            customClass: { icon: 'gc-swal-icon' + (form.dataset.danger ? ' gc-swal-icon--danger' : ''), popup: 'gc-swal-popup' },
            showCancelButton: true,
            confirmButtonText: '<i class="' + (form.dataset.confirmIcon || 'fa fa-paper-plane') + '"></i> ' + form.dataset.confirm,
            cancelButtonText: 'Cancel',
            confirmButtonColor: form.dataset.danger ? '#d33' : primary,
            cancelButtonColor: '#8a96a3',
            reverseButtons: true,
            focusCancel: true,
            showLoaderOnConfirm: true,
            allowOutsideClick: function () { return !Swal.isLoading(); },
            preConfirm: function () {
                form.dataset.confirmed = '1';
                form.submit();
                return new Promise(function () {});
            }
        });
    });
});
</script>
@endpush
