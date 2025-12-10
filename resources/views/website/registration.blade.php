@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
    @if (!empty($banner->image))
        <section class="inner-banner registration-banner"
            style="background-image: url('{{asset('/admin/assets/images/banner') }}/{{ $banner->image }}');">
        @else
        <section class="inner-banner registration-banner" 
            style="background-image: url('{{asset('/admin/assets/images/images.png') }}');" style="width:100%">
    @endif
        <div class="banner-wrapper position-relative z-1">
            <div class="container">
                <div class="row">
                    @include('website.include.social-links')
                    <div class="col-lg-7 col-xl-6" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <div class="card">
                            <div class="shape-1"></div>
                            @if (isset($banner))
                                <h1 class="hd-70">{{ $banner->name }}</h1> 
                            @endif
                        </div>
                    </div>
                </div>
                <a href="#sec-1" class="">
                    <div class="top-to-bottom">
                        <i class="fa-solid fa-arrow-down"></i>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <section class="registration-sec pt-100" id="sec-1">
        <div class="container">
            <h2 class="hd-70 heading text-primary-theme mb-20 text-center" data-aos="flip-left" data-aos-easing="linear"
                data-aos-duration="1500">Registration</h2>
            <h6 class="text-secondry-theme fs-20 fw-700 mb-20 text-center" data-aos="fade-up" data-aos-easing="linear"
                data-aos-duration="1500">Thank you for your interest in FITNEX!</h6>
            <p class="hd-20 fw-medium mb-60 text-center" data-aos="fade-up" data-aos-easing="linear"
                data-aos-duration="1500">
                Choose from two membership types, Standard or Platinum. Platinum includes the standard membership, but also
                allows your company representative a non-voting presence at FITNEX board meetings. Please select below to
                begin registration. Once payment is made, you will be directed to a member directory profile form. You can
                also access the directory info form here.
            </p>
            {{-- <div class="row row-gap-40">
                @foreach($packages as $package)
                <div class="col-lg-4" data-aos="fade-{{ $loop->iteration % 2 == 0 ? 'left' : 'right' }}" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="card-lg text-center">
                        <h3 class="hd-20 text-white mb-30">{{ $package->title }}</h3>
                        <div class="text-white mb-30 package_description">{!! $package->description !!}</div>
                        <h3 class="hd-20 text-white mb-30">${{ number_format($package->price, 2) }} {{ $package->period }}</h3>
                        <a href="{{ route('sign-up', ['package_id' => $package->id]) }}" 
                           class="btn btn-secondry pack mx-auto d-flex justify-content-center text-uppercase w-100"
                           style="font-size: 2rem;">ADD TO CART</a>
                    </div>
                </div>
                @endforeach
            </div> --}}
            <div class="text-center mt-4">
                <span>Already a platinum member or EPC?</span>
                <a href="{{ route('login') }}" class="btn btn-primary ms-2">
                    <i class="fa fa-sign-in-alt"></i> Login
                </a>
            </div>
        </div>
    </section>
@endsection
