@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Session Pricing</h4>
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

                    <p class="text-muted">Set your pricing for different session durations. Customers will be charged based on the session duration they book.</p>

                    <form action="{{ route('trainer.pricing.update') }}" method="POST">
                        @csrf

                        <div class="row">
                            @foreach($durations as $duration)
                                @php
                                    $existingPricing = $pricing->get($duration);
                                @endphp
                                <div class="col-md-4 mb-4">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0">{{ $duration }} Minutes Session</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="price_{{ $duration }}" class="form-label">
                                                    Price (USD) <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" 
                                                           name="pricing[{{ $loop->index }}][price]" 
                                                           id="price_{{ $duration }}"
                                                           class="form-control @error("pricing.{$loop->index}.price") is-invalid @enderror" 
                                                           value="{{ old("pricing.{$loop->index}.price", $existingPricing->price ?? '') }}" 
                                                           step="0.01" 
                                                           min="0" 
                                                           max="9999.99"
                                                           required>
                                                </div>
                                                @error("pricing.{$loop->index}.price")
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <input type="hidden" 
                                                   name="pricing[{{ $loop->index }}][session_duration]" 
                                                   value="{{ $duration }}">
                                            <input type="hidden" 
                                                   name="pricing[{{ $loop->index }}][currency]" 
                                                   value="USD">

                                            <div class="form-check">
                                                <input type="checkbox" 
                                                       name="pricing[{{ $loop->index }}][is_active]" 
                                                       id="active_{{ $duration }}"
                                                       class="form-check-input" 
                                                       value="1"
                                                       {{ old("pricing.{$loop->index}.is_active", $existingPricing->is_active ?? true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="active_{{ $duration }}">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Update Pricing
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
