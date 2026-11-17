@extends('layouts.admin.app')

@section('title', 'Stripe Connect')

@section('content')
<section class="content-header">
    <h1>Stripe Connect <small>Trainer payouts</small></h1>
</section>

<section class="content">
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-green"><span class="info-box-icon"><i class="fa fa-check"></i></span><div class="info-box-content"><span class="info-box-text">Connected</span><span class="info-box-number">{{ $stats['connected'] }}</span></div></div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-yellow"><span class="info-box-icon"><i class="fa fa-clock-o"></i></span><div class="info-box-content"><span class="info-box-text">Pending</span><span class="info-box-number">{{ $stats['pending'] }}</span></div></div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-aqua"><span class="info-box-icon"><i class="fa fa-pause"></i></span><div class="info-box-content"><span class="info-box-text">Held payouts</span><span class="info-box-number">{{ $stats['held'] }}</span></div></div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-red"><span class="info-box-icon"><i class="fa fa-hand-paper-o"></i></span><div class="info-box-content"><span class="info-box-text">Manual pending</span><span class="info-box-number">{{ $stats['manual_pending'] }}</span></div></div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Commission settings</h3>
        </div>
        <form method="POST" action="{{ route('admin.stripe-connect.settings') }}">
            @csrf
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Platform commission (%)</label>
                            <input type="number" step="0.01" min="0" max="100" name="commission_percent" class="form-control" value="{{ old('commission_percent', $settings['commission_percent']) }}" required>
                            <p class="help-block">Currently starts at 10% for all trainers.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stripe fees paid by</label>
                            <select name="fee_bearer" class="form-control" required>
                                <option value="trainer" @selected(old('fee_bearer', $settings['fee_bearer']) === 'trainer')>Trainer</option>
                                <option value="platform" @selected(old('fee_bearer', $settings['fee_bearer']) === 'platform')>Platform (Fitnex)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payout timing</label>
                            <select name="payout_trigger" class="form-control" required>
                                <option value="session_complete" @selected(old('payout_trigger', $settings['payout_trigger']) === 'session_complete')>After session completed</option>
                                <option value="booking" @selected(old('payout_trigger', $settings['payout_trigger']) === 'booking')>When booking is paid</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save settings</button>
            </div>
        </form>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Trainer Stripe status</h3>
            <div class="box-tools">
                <a href="{{ route('admin.stripe-connect.index', ['filter' => 'all']) }}" class="btn btn-xs btn-default {{ $filter === 'all' ? 'active' : '' }}">All</a>
                <a href="{{ route('admin.stripe-connect.index', ['filter' => 'connected']) }}" class="btn btn-xs btn-default {{ $filter === 'connected' ? 'active' : '' }}">Connected</a>
                <a href="{{ route('admin.stripe-connect.index', ['filter' => 'not_connected']) }}" class="btn btn-xs btn-default {{ $filter === 'not_connected' ? 'active' : '' }}">Not connected</a>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Trainer</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Payouts</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trainers as $trainer)
                        <tr>
                            <td>{{ $trainer->name }}</td>
                            <td>{{ $trainer->user->email ?? '—' }}</td>
                            <td>{{ $trainer->stripe_country ?: '—' }}</td>
                            <td>
                                @php $st = $trainer->stripe_connect_status ?: 'not_connected'; @endphp
                                <span class="label {{ $st === 'connected' ? 'label-success' : ($st === 'pending' ? 'label-warning' : 'label-default') }}">{{ str_replace('_',' ', $st) }}</span>
                            </td>
                            <td>{{ $trainer->stripe_payouts_enabled ? 'Yes' : 'No' }}</td>
                            <td>
                                @if($trainer->stripe_account_id)
                                    <form method="POST" action="{{ route('admin.stripe-connect.refresh', $trainer) }}" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-xs btn-default">Refresh</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No trainers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Recent payouts</h3>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Trainer</th>
                        <th>Price</th>
                        <th>Commission</th>
                        <th>Trainer share</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $payout)
                        <tr>
                            <td>#{{ $payout->id }}</td>
                            <td>{{ $payout->name }}</td>
                            <td>{{ $payout->trainer->name ?? '—' }}</td>
                            <td>${{ number_format((float)$payout->price, 2) }}</td>
                            <td>${{ number_format((float)($payout->platform_commission_amount ?? 0), 2) }}</td>
                            <td>${{ number_format((float)($payout->trainer_payout_amount ?? 0), 2) }}</td>
                            <td>
                                <span class="label {{ $payout->payout_status === 'transferred' || $payout->payout_status === 'manual_paid' ? 'label-success' : ($payout->payout_status === 'manual_pending' || $payout->payout_status === 'failed' ? 'label-danger' : 'label-warning') }}">
                                    {{ str_replace('_',' ', $payout->payout_status) }}
                                </span>
                                @if($payout->payout_error)
                                    <br><small class="text-muted">{{ \Illuminate\Support\Str::limit($payout->payout_error, 80) }}</small>
                                @endif
                            </td>
                            <td style="white-space:nowrap;">
                                @if(in_array($payout->payout_status, ['held', 'manual_pending', 'failed'], true))
                                    <form method="POST" action="{{ route('admin.stripe-connect.release', $payout) }}" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-xs btn-primary">Release</button>
                                    </form>
                                @endif
                                @if($payout->payout_status === 'manual_pending')
                                    <form method="POST" action="{{ route('admin.stripe-connect.manual-paid', $payout) }}" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-xs btn-success">Mark paid</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center">No payout records yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
