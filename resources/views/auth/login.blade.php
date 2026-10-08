@extends('layouts.website.master')
@section('title', $page_title ?? 'Log In')

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

                <h1 class="login-page__title">Welcome back</h1>
                <p class="login-page__subtitle">Log in to continue your fitness journey.</p>

                @if (Session::has('error'))
                    <p class="alert alert-danger" id="error-alert">{{ Session::get('error') }}</p>
                @endif
                @if (Session::has('message'))
                    <p class="alert alert-success" id="success-alert">{{ Session::get('message') }}</p>
                @endif
                @if (Session::has('warning'))
                    <p class="alert alert-warning" id="warning-alert">{{ Session::get('warning') }}</p>
                @endif

                <form method="POST" action="{{ route('user.authenticate') }}">
                    @csrf
                    <div class="form-group field-wrap">
                        <label class="login-label" for="login-email">Email</label>
                        <div class="input-wrap">
                            <input class="input-field" id="login-email" name="email" value="{{ old('email') }}" type="email"
                                placeholder="Enter your email" required autocomplete="email">
                            <span class="input-icon" aria-hidden="true"><i class="fa-regular fa-envelope"></i></span>
                        </div>
                        <span class="field-error">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group field-wrap">
                        <label class="login-label" for="login-password">Password</label>
                        <div class="input-wrap">
                            <input class="input-field" id="login-password" type="password" placeholder="Enter your password"
                                name="password" required autocomplete="current-password">
                            <button type="button" class="input-icon input-icon--toggle" id="toggle-password"
                                aria-label="Show password">
                                <i class="fa-regular fa-eye" id="toggle-password-icon"></i>
                            </button>
                        </div>
                        <span class="field-error">{{ $errors->first('password') }}</span>
                    </div>

                    <div class="forgot-row">
                        <a href="{{ route('forgot-password') }}">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-continue" name="form1">Continue</button>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Keep me logged in</label>
                    </div>
                </form>

                <div class="login-resend">
                    <button type="button" class="login-resend__toggle" id="resend-toggle">
                        Didn't get the verification email? Resend it
                    </button>
                    <form class="login-resend__form" id="resend-form" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <label class="login-label" for="resend-email">Email address</label>
                        <div class="input-wrap">
                            <input class="input-field" id="resend-email" name="email" type="email"
                                value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="email">
                            <span class="input-icon" aria-hidden="true"><i class="fa-regular fa-envelope"></i></span>
                        </div>
                        <button type="submit" class="btn-resend">Send verification email</button>
                    </form>
                </div>

                <hr class="form-divider">

                <div class="form-under-btn">
                    <p class="mb-0">Don't have an account? <a href="{{ route('sign-up') }}">Register</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var passwordInput = document.getElementById('login-password');
        var toggleBtn = document.getElementById('toggle-password');
        var toggleIcon = document.getElementById('toggle-password-icon');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function () {
                var isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                toggleIcon.classList.toggle('fa-eye', !isPassword);
                toggleIcon.classList.toggle('fa-eye-slash', isPassword);
                toggleBtn.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
            });
        }

        var resendToggle = document.getElementById('resend-toggle');
        var resendForm = document.getElementById('resend-form');

        if (resendToggle && resendForm) {
            resendToggle.addEventListener('click', function () {
                resendForm.classList.toggle('is-open');
            });

            @if (Session::has('warning') || (Session::has('error') && str_contains(strtolower(Session::get('error')), 'verify')))
                resendForm.classList.add('is-open');
            @endif
        }

        ['error-alert', 'success-alert', 'warning-alert'].forEach(function (id) {
            var alert = document.getElementById(id);
            if (alert) {
                setTimeout(function () {
                    alert.style.display = 'none';
                }, 10000);
            }
        });
    });
</script>
@endsection
