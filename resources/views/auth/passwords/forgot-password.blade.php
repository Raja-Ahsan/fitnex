@extends('layouts.website.master')
@section('title', $page_title ?? 'Forgot Password')

@push('styles')
@include('auth.partials.auth-card-styles')
@endpush

@section('content')
    <section class="login-page">
        <div class="login-page__inner">
            <div class="log-forms">
                <div class="login-page__brand" aria-label="FITNEX">
                    <span class="login-page__brand-fit">FIT</span><span class="login-page__brand-nex">NEX</span>
                </div>

                <div class="auth-icon" aria-hidden="true"><i class="fa-solid fa-key"></i></div>

                <h1 class="login-page__title">Forgot your password?</h1>
                <p class="login-page__subtitle">No worries. Enter the email on your account and we'll send you a link to set a new password.</p>

                @if (Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                @if (Session::has('message'))
                    <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif

                <ul class="auth-steps">
                    <li><span class="auth-steps__num">1</span><span>Enter your account email below.</span></li>
                    <li><span class="auth-steps__num">2</span><span>Open the email from FITNEX (check your spam folder too).</span></li>
                    <li><span class="auth-steps__num">3</span><span>Click the link and choose your new password.</span></li>
                </ul>

                <form method="POST" action="{{ route('password.reset-link') }}" id="forgot-form">
                    @csrf
                    <div class="form-group field-wrap">
                        <label class="login-label" for="forgot-email">Email</label>
                        <div class="input-wrap">
                            <input class="input-field" id="forgot-email" name="email" type="email" value="{{ old('email') }}"
                                placeholder="Enter your email" required autocomplete="email" autofocus>
                            <span class="input-icon" aria-hidden="true"><i class="fa-regular fa-envelope"></i></span>
                        </div>
                        <span class="field-error">{{ $errors->first('email') }}</span>
                    </div>

                    <button type="submit" class="btn btn-continue" id="forgot-submit">Send reset link</button>
                </form>

                <hr class="form-divider">

                <div class="form-under-btn">
                    <a href="{{ route('login') }}" class="auth-back"><i class="fa-solid fa-arrow-left"></i> Back to login</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('forgot-form');
        var btn = document.getElementById('forgot-submit');
        if (form && btn) {
            form.addEventListener('submit', function () {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending...';
            });
        }
    });
</script>
@endsection
