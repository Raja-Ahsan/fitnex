@extends('layouts.trainer.app')

@section('title', 'Stripe Payouts')

@push('css')
@include('trainer.partials.theme-styles')
<style>
    .sc-card { background:#fff; border:1px solid var(--fit-border,#e5eaf0); border-radius:14px; padding:22px; margin-bottom:18px; }
    .sc-status { display:inline-flex; align-items:center; gap:8px; padding:8px 14px; border-radius:999px; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.04em; }
    .sc-status--connected { background:rgba(46,125,50,.12); color:#2e7d32; }
    .sc-status--pending { background:rgba(245,124,0,.12); color:#e65100; }
    .sc-status--restricted { background:rgba(198,40,40,.1); color:#c62828; }
    .sc-status--not_connected { background:rgba(108,122,136,.12); color:#546e7a; }
    .sc-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:12px; margin:16px 0; }
    .sc-stat { background:var(--fit-bg,#f4f8fc); border:1px solid var(--fit-border,#e5eaf0); border-radius:12px; padding:14px; }
    .sc-stat label { display:block; font-size:11px; text-transform:uppercase; letter-spacing:.05em; color:#6c7a88; margin-bottom:4px; }
    .sc-stat strong { font-size:1.15rem; color:var(--fit-primary,#004274); }
    .sc-steps { margin:0; padding-left:18px; color:#4a5a6a; line-height:1.6; }
    .sc-actions { display:flex; flex-wrap:wrap; gap:10px; margin-top:16px; }
</style>
@endpush

@section('content')
<section class="content-header">
    <h1>Stripe Payouts</h1>
</section>

<section class="content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="sc-card">
        @php $status = $trainer->stripe_connect_status ?: 'not_connected'; @endphp
        <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;align-items:center;">
            <div>
                <h3 style="margin:0 0 6px;color:var(--fit-primary,#004274);">Get paid automatically</h3>
                <p style="margin:0;color:#4a5a6a;">Connect your Stripe account once. After each session is marked complete, Fitnex keeps {{ number_format($settings['commission_percent'], 0) }}% and sends your share to you.</p>
            </div>
            <span class="sc-status sc-status--{{ $status }}">{{ str_replace('_', ' ', $status) }}</span>
        </div>

        <div class="sc-grid">
            <div class="sc-stat">
                <label>Platform commission</label>
                <strong>{{ number_format($settings['commission_percent'], 0) }}%</strong>
            </div>
            <div class="sc-stat">
                <label>Stripe fees paid by</label>
                <strong>{{ $settings['fee_bearer'] === 'trainer' ? 'Trainer' : 'Platform' }}</strong>
            </div>
            <div class="sc-stat">
                <label>Payout timing</label>
                <strong>{{ $settings['payout_trigger'] === 'session_complete' ? 'After session complete' : 'On booking' }}</strong>
            </div>
        </div>

        @if($status === 'connected')
            <p style="color:#2e7d32;margin-bottom:0;"><i class="fa fa-check-circle"></i> Your Stripe account is ready. When you mark a booking as completed, your payout will be released automatically.</p>
            <div class="sc-actions">
                @if($loginUrl)
                    <a href="{{ $loginUrl }}" class="btn btn-primary" target="_blank" rel="noopener">Open Stripe Dashboard</a>
                @endif
                <form method="POST" action="{{ route('trainer.stripe.connect') }}" style="display:inline;">
                    @csrf
                    <input type="hidden" name="country" value="{{ $trainer->stripe_country ?: 'US' }}">
                    <button type="submit" class="btn btn-default">Update Stripe details</button>
                </form>
            </div>
        @else
            <ol class="sc-steps">
                <li>Choose your country and click Connect with Stripe.</li>
                <li>Complete Stripe’s secure verification (ID + bank details).</li>
                <li>Come back here — status should show Connected.</li>
                <li>After each completed session, your payout is released automatically.</li>
            </ol>

            <form method="POST" action="{{ route('trainer.stripe.connect') }}" class="sc-actions" style="align-items:flex-end;">
                @csrf
                <div>
                    <label for="country" style="display:block;font-weight:600;margin-bottom:6px;">Your country</label>
                    <select name="country" id="country" class="form-control" required style="min-width:220px;">
                        <option value="">Select country</option>
                        @foreach($countries as $code => $label)
                            <option value="{{ $code }}" @selected(old('country', $trainer->stripe_country) === $code)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('country')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    {{ $trainer->stripe_account_id ? 'Continue Stripe setup' : 'Connect with Stripe' }}
                </button>
            </form>

            <p style="margin-top:14px;color:#6c7a88;font-size:13px;">If Stripe is not available in your country, Fitnex can still pay you manually after completed sessions.</p>
        @endif
    </div>
</section>
@endsection
