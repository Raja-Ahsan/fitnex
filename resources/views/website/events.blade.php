@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
    @if (!empty($banner->image))
        <section class="inner-banner events-banner"
            style="background-image: url('{{asset('/admin/assets/images/banner') }}/{{ $banner->image }}');">
        @else
            <section class="inner-banner events-banner"
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
    <section class="event-sec pt-100" id="sec-1">
        <div class="container">
            <h2 class="hd-70 heading text-primary-theme mb-20 text-center mb-100" data-aos="flip-left"
                data-aos-easing="linear" data-aos-duration="1500">Join us at an <span>FITNEX event!</span>
            </h2>

            <div class="row row-gap-60">
                <div class="col-lg-4" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="img-wrapper md-shape theme-blue">
                        <img src="{{ asset('/assets/website') }}/images/events-01.png" class=""
                            alt="Events fitnex">
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="img-wrapper md-shape">
                        <img src="{{ asset('/assets/website') }}/images/events-02.png" class=""
                            alt="Events fitnex">
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="img-wrapper md-shape">
                        <img src="{{ asset('/assets/website') }}/images/events-03.png" class=""
                            alt="Events fitnex">
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="img-wrapper md-shape theme-blue">
                        <img src="{{ asset('/assets/website') }}/images/events-04.png" class=""
                            alt="Events fitnex">
                    </div>
                </div>
            </div>
    </section>
    <section class="registration-sec pt-100">
        <div class="container">
            <h2 class="hd-70 heading text-primary-theme mb-20 text-center" data-aos="flip-left" data-aos-easing="linear" data-aos-duration="1500">Upcoming:</h2>
            <div class="row justify-content-center">
                @foreach($events as $event)
                    <div class="col-lg-8" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <div class="card-lg text-center p-4 mb-4">
                            <h3 class="hd-20 text-primary-theme mb-3">{{ $event['title'] }}</h3>
                            <p class="mb-1 text-white">{{ $event['host'] }}</p>
                            <p class="mb-1 text-white">{{ \Carbon\Carbon::parse($event['date'])->format('l, F d, Y') }}</p>
                            <p class="mb-1 text-white">
                                {{
                                    str_replace(['am', 'pm'], ['a.m.', 'p.m.'],
                                        \Carbon\Carbon::parse($event['time'])->format('g:i a')
                                    )
                                }}
                                until
                                {{
                                    str_replace(['am', 'pm'], ['a.m.', 'p.m.'],
                                        \Carbon\Carbon::parse($event['end_time'])->format('g:i a')
                                    )
                                }}
                            </p>
                            <p class="mb-3 text-white">
                                @if(!empty($event['location_link']))
                                    <a href="{{ $event['location_link'] }}" target="_blank" class="text-white" style="text-decoration: underline;">
                                        {{ $event['location'] }}
                                    </a>
                                @else
                                    {{ $event['location'] }}
                                @endif
                            </p>
                            <a href="{{ $event['registration_link'] }}" target="_blank" class="btn btn-primary pack mx-auto d-flex justify-content-center text-capitalize w-100" style="font-size: 1.5rem; max-width: 300px;">REGISTER HERE</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
