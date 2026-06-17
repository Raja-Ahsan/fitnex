@extends('layouts.website.master')
@section('title', $page_title ?? 'Log In')

@push('styles')
<style>
    .login-page {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 16px 64px;
        background: #000;
    }

    .login-page__inner {
        width: 100%;
        max-width: 420px;
        margin: 0 auto;
    }

    .log-forms {
        padding: 36px 32px 28px;
        border-radius: 16px;
        background: #121212;
        border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .login-page__brand {
        text-align: center;
        margin-bottom: 28px;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
        font-size: 1.75rem;
        font-weight: 800;
        font-style: italic;
        letter-spacing: 0.02em;
        line-height: 1;
    }

    .login-page__brand-fit {
        color: #0079D4;
    }

    .login-page__brand-nex {
        color: #fff;
    }

    .login-page__title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 8px;
        line-height: 1.2;
        text-align: center;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page__subtitle {
        margin: 0 0 28px;
        text-align: center;
        color: #a0a0a0;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .login-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #fff;
        margin-bottom: 8px;
    }

    .login-page .input-wrap {
        position: relative;
    }

    .login-page .input-field {
        width: 100%;
        border: 1px solid transparent;
        border-radius: 10px;
        padding: 14px 44px 14px 14px;
        background: #1e1e1e;
        color: #fff;
        font-size: 0.95rem;
        margin-bottom: 4px;
        box-sizing: border-box;
    }

    .login-page .input-field::placeholder {
        color: #6b6b6b;
    }

    .login-page .input-field:focus {
        outline: none;
        border-color: #0079D4;
        box-shadow: 0 0 0 3px rgba(0, 121, 212, 0.2);
    }

    .login-page .input-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0a0a0;
        font-size: 0.95rem;
        pointer-events: none;
    }

    .login-page .input-icon--toggle {
        pointer-events: auto;
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        line-height: 1;
    }

    .login-page .input-icon--toggle:hover {
        color: #fff;
    }

    .login-page .field-wrap {
        margin-bottom: 18px;
    }

    .login-page .forgot-row {
        text-align: right;
        margin: -4px 0 20px;
    }

    .login-page .forgot-row a {
        color: #0079D4;
        font-size: 0.875rem;
        text-decoration: none;
    }

    .login-page .forgot-row a:hover {
        text-decoration: underline;
    }

    .login-page .btn-continue {
        width: 100%;
        background-color: #0079D4;
        border: none;
        border-radius: 10px;
        padding: 14px 0;
        font-weight: 700;
        font-size: 1rem;
        color: #fff;
        transition: background-color 0.2s;
        margin-top: 4px;
    }

    .login-page .btn-continue:hover {
        background-color: #0066b8;
        color: #fff;
    }

    .login-page .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 16px;
    }

    .login-page .form-check-input {
        width: 16px;
        height: 16px;
        margin: 0;
        accent-color: #0079D4;
        background-color: #1e1e1e;
        border-color: #3a3a3a;
    }

    .login-page .form-check-label {
        color: #fff;
        font-size: 0.9rem;
        margin: 0;
        cursor: pointer;
    }

    .login-page .form-divider {
        border: 0;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        margin: 24px 0 20px;
    }

    .login-page .form-under-btn {
        text-align: center;
        font-size: 0.9rem;
        color: #a0a0a0;
    }

    .login-page .form-under-btn a {
        color: #0079D4;
        font-weight: 600;
        text-decoration: none;
    }

    .login-page .form-under-btn a:hover {
        text-decoration: underline;
    }

    .login-page .alert {
        border-radius: 12px;
        font-size: 0.875rem;
        line-height: 1.5;
        margin: 0 0 16px;
        padding: 14px 18px;
        border: none;
        text-align: center;
    }

    .login-page .alert-danger {
        background: rgba(220, 53, 69, 0.15);
        color: #ff8a95;
        border: 1px solid rgba(220, 53, 69, 0.25);
    }

    .login-page .alert-success {
        background: rgba(25, 135, 84, 0.15);
        color: #75d9a3;
        border: 1px solid rgba(25, 135, 84, 0.25);
    }

    .login-page .alert-warning {
        background: rgba(255, 193, 7, 0.12);
        color: #ffd666;
        border: 1px solid rgba(255, 193, 7, 0.25);
    }

    .login-page .field-error {
        color: #ff8a95;
        font-size: 0.8rem;
        display: block;
        margin-top: 6px;
        padding: 10px 14px;
        line-height: 1.45;
        border-radius: 10px;
        background: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.2);
    }

    .login-page .field-error:empty {
        display: none;
        padding: 0;
        margin: 0;
        border: none;
        background: none;
    }

    .login-resend {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .login-resend__toggle {
        background: none;
        border: none;
        color: #0079D4;
        font-size: 0.875rem;
        padding: 0;
        cursor: pointer;
        text-decoration: underline;
    }

    .login-resend__form {
        display: none;
        margin-top: 12px;
    }

    .login-resend__form.is-open {
        display: block;
    }

    .login-resend__form .btn-resend {
        width: 100%;
        margin-top: 10px;
        background: transparent;
        border: 1px solid #0079D4;
        color: #0079D4;
        border-radius: 10px;
        padding: 10px 0;
        font-weight: 600;
        font-size: 0.9rem;
        transition: background-color 0.2s, color 0.2s;
    }

    .login-resend__form .btn-resend:hover {
        background: #0079D4;
        color: #fff;
    }
</style>
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
