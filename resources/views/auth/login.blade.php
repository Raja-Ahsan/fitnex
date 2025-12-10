@extends('layouts.website.master')
@section('title', $page_title)
<style>
    .log-forms {
    padding: 30px;
    margin: 20px;
    border-radius: 20px;
    background: linear-gradient(315deg, #4ab0f5, #ffffff);
    box-shadow: 18px 20px 20px 0px rgb(0 0 0 / 21%), 0 6px 20px rgb(0 0 0 / 8%);
    }
    .login-sec {
        padding: 50px 0;
    }
</style>
@section('content')
    {{-- <section class="inner-banner listing-banner" style="background: url(' {{ asset('/assets/website/images/trainer-banner.webp') }}') no-repeat center/cover;">
        <div class="container">
            <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1] lg:max-w-[680px] xxl:max-w-[860px] k+pfr5Wx@I8MPO@UuY'2"
                data-aos="flip-right"
                data-aos-easing="linear"
                data-aos-duration="1500"> <span class="italic uppercase font-black"><span class="primary-theme">LOGIN</span></span>
            </h1>
        </div>
    </section> --}}
    <section class="inner-banner listing-banner" style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/'.$banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
        <div class="container">
            <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1]" data-aos="flip-right" data-aos-easing="linear" data-aos-duration="1500">
                @php
                    $title = ($banner && $banner->name) ? $banner->name : '';
                    $parts = explode(' ', $title, 2);
                @endphp
                <span class="italic uppercase font-black">
                    <span class="primary-theme-text">{{ $parts[0] }}</span>@if(isset($parts[1])) {{ $parts[1] }}@endif
                </span>
            </h1>
        </div>
      </section>

    <section class="login-sec pt-b-80">
        <div class="container py-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="login-content">
                    <div>
                        <h4 class="text-uppercase hd-42 heading mb-20"><span>WELCOME</span> TO</h4>
                        <h1 class="login-head hd-20 mb-20 text-capitalize">FITNEX
                        </h1>
                        <p class="hd-20 fw-medium text-capitalize">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna alion.</p>
                    </div>
                </div>
                <div class="form-bg card-body" data-aos="flip-left" data-aos-easing="linear"
                data-aos-duration="1500">
                    <div class="log-forms">
                        <h1 class="login-head text-uppercase hd-42 heading mb-20"><span>LOGIN NOW</span></h1>
                        @if (Session::has('error'))
                            <p class="alert alert-danger" id="error-alert">{{ Session::get('error') }}</p>
                        @endif
                        @if (Session::has('message'))
                            <p class="alert alert-success" id="success-alert">{{ Session::get('message') }}</p>
                        @endif
                        <form method="POST" action="{{ route('user.authenticate') }}">
                            @csrf
                            <div class="form-group field-wrap" style="margin-bottom: 10px;">
                                <input class="input-field" name="email" value="{{ old('email') }}" type="email"
                                    placeholder="Email Address" style="border: 1px solid #cd8904;">
                                <span style="color: red">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="form-group field-wrap" style="margin-bottom: 10px;">
                                <input class="input-field" type="password" placeholder="Password" name="password" required
                                    autocomplete="current-password" style="border: 1px solid #cd8904;">
                                <span style="color: red">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn primary-btn d-flex justify-content-center text-capitalize w-full mb-10" name="form1" style="background-color: #007bff; border-color: #007bff; border-radius: 7px; padding: 10px 0; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#0056b3'" onmouseout="this.style.backgroundColor='#007bff'">Login</button>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                                <label class="login-head fs-18" for="flexCheckDefault">
                                    Keep me logged in
                                </label>
                            </div>
                        </form>
                        <div class="form-under-btn">
                            <div class="forgot"><a href="{{ route('forgot-password') }}">Forgot Password?</a></div>
                            <p>Don't have an account? <a href="{{ route('registration') }}">Register</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BANNER SEC -->
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.style.display = 'none';
            }, 10000); // 10 seconds
        }
    });
</script>
