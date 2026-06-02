@extends('layouts.website.master')
@section('title', $page_title ?? 'Log In')

@push('styles')
<style>
    .login-page {
        min-height: calc(100vh - 180px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 16px;
    }

    .login-page__inner {
        width: 100%;
        max-width: 420px;
        margin: 0 auto;
    }

    .log-forms {
        padding: 32px 28px;
        border-radius: 20px;
        background: linear-gradient(315deg, #4ab0f5, #ffffff);
        box-shadow: 18px 20px 20px 0px rgb(0 0 0 / 21%), 0 6px 20px rgb(0 0 0 / 8%);
    }

    .login-page__title {
        font-size: 2rem;
        font-weight: 700;
        color: #101010;
        margin: 0 0 24px;
        line-height: 1.2;
    }

    .login-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #004274;
        margin-bottom: 8px;
    }

    .login-page .input-field {
        width: 100%;
        border: 1px solid #cd8904;
        border-radius: 8px;
        padding: 12px 14px;
        background: #fff;
        margin-bottom: 4px;
    }

    .login-page .input-field:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
    }

    .login-page .field-wrap {
        margin-bottom: 16px;
    }

    .login-page .btn-continue {
        width: 100%;
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 999px;
        padding: 12px 0;
        font-weight: 700;
        color: #fff;
        border: none;
        transition: background-color 0.3s;
        margin-top: 8px;
    }

    .login-page .btn-continue:hover {
        background-color: #0056b3;
        color: #fff;
    }

    .login-page .form-check {
        margin-top: 14px;
    }

    .login-recaptcha {
        margin: 18px 0 0;
        font-size: 11px;
        line-height: 1.5;
        color: #6c757d;
        text-align: center;
    }

    .login-recaptcha a {
        color: #007bff;
        text-decoration: underline;
    }

    .form-under-btn {
        margin-top: 18px;
        text-align: center;
        font-size: 14px;
    }

    .form-under-btn a {
        color: #007bff;
        font-weight: 600;
    }

    .login-page .alert {
        border-radius: 8px;
        font-size: 14px;
        margin-bottom: 16px;
    }
</style>
@endpush

@section('content')
    
{{-- <section class="inner-banner listing-banner" style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/'.$banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
    <div class="container">
        <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1]" >
            @php
                $title = ($banner && $banner->name) ? $banner->name : '';
                $parts = explode(' ', $title, 2);
            @endphp
            <span class="italic uppercase font-black">
                <span class="primary-theme-text">{{ $parts[0] }}</span>@if(isset($parts[1])) {{ $parts[1] }}@endif
            </span>
        </h1>
    </div>
  </section> --}}
{{-- Banner Section End --}}
    <section class="login-page">
        <div class="login-page__inner">
            <div class="form-bg card-body" data-aos="flip-left" data-aos-easing="linear" data-aos-duration="1500">
                <div class="log-forms">
                    <h1 class="login-page__title">Log in</h1>

                    @if (Session::has('error'))
                        <p class="alert alert-danger" id="error-alert">{{ Session::get('error') }}</p>
                    @endif
                    @if (Session::has('message'))
                        <p class="alert alert-success" id="success-alert">{{ Session::get('message') }}</p>
                    @endif
                    @if (Session::has('warning'))
                        <p class="alert alert-warning">{{ Session::get('warning') }}</p>
                    @endif

                    <form method="POST" action="{{ route('user.authenticate') }}">
                        @csrf
                        <div class="form-group field-wrap">
                            <label class="login-label" for="login-email">Email address</label>
                            <input class="input-field" id="login-email" name="email" value="{{ old('email') }}" type="email"
                                placeholder="Email address" required autocomplete="email">
                            <span style="color: red; font-size: 13px;">{{ $errors->first('email') }}</span>
                        </div>

                        <div class="form-group field-wrap">
                            <label class="login-label" for="login-password">Password</label>
                            <input class="input-field" id="login-password" type="password" placeholder="Password"
                                name="password" required autocomplete="current-password">
                            <span style="color: red; font-size: 13px;">{{ $errors->first('password') }}</span>
                        </div>

                        <button type="submit" class="btn btn-continue" name="form1">Continue</button>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                            <label class="login-head fs-18" for="flexCheckDefault">Keep me logged in</label>
                        </div>
                    </form>

                   {{--  <p class="login-recaptcha">
                        This site is protected by reCAPTCHA and the Google
                        <a href="{{ route('privacy-policy') }}" target="_blank" rel="noopener">Privacy Policy</a> and
                        <a href="{{ route('terms-of-service') }}" target="_blank" rel="noopener">Terms of Service</a> apply.
                    </p> --}}

                    <div class="form-under-btn">
                        <div class="forgot"><a href="{{ route('forgot-password') }}">Forgot password?</a></div>
                        <p class="mb-0">Don't have an account? <a href="{{ route('registration') }}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof AOS !== 'undefined') {
            AOS.init();
        }

        var errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            setTimeout(function () {
                errorAlert.style.display = 'none';
            }, 10000);
        }
    });
</script>
@endsection
