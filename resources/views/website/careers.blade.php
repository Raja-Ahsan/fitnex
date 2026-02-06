@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
    @if (!empty($banner->image))
        <section class="inner-banner about-banner"
            style="background-image: url('{{asset('/admin/assets/images/banner') }}/{{ $banner->image }}');">
        @else
            <section class="inner-banner about-banner"
                style="background-image: url('{{asset('/admin/assets/images/images.png') }}');" style="width:100%">
    @endif
    <div class="banner-wrapper position-relative z-1">
        <div class="container">
            <div class="row">
                @include('website.include.social-links')
                <div class="col-lg-6 col-xl-5" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
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

    <section class="about-sec-4 pb-70" >
        <div class="container">
            <h2 class="hd-70 heading mb-20 mt-5 text-center" data-aos="flip-left" data-aos-easing="linear"
                data-aos-duration="1500">
                <span class="text-primary-theme">{!! $home_page_data['careers_heading'] !!}</span>
            </h2>
            <p class="hd-20 fw-medium text-left mb-20 text-capitalize" data-aos="fade-down" data-aos-easing="linear"
                data-aos-duration="1500">
                {!! $home_page_data['job_summary'] !!}
            </p>
            <p class="mb-20" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                {!! $home_page_data['job_description'] !!}
            </p>
            <p class="hd-20 fw-medium text-left mb-20 text-capitalize" data-aos="fade-down" data-aos-easing="linear"
                data-aos-duration="1500">
                {!! $home_page_data['job_functions'] !!}
            </p>
            <div class="mb-20" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                {!! $home_page_data['job_functions_description'] !!}
            </div>
            <p class="hd-20 fw-medium text-left mb-20 text-capitalize" data-aos="fade-down" data-aos-easing="linear"
                data-aos-duration="1500">
                {!! $home_page_data['knowledge_skills_heading'] !!}
            </p>
            <div class="mb-20" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                {!! $home_page_data['knowledge_skills_description'] !!}
            </div>
            <p class="hd-20 fw-medium text-left mb-20 text-capitalize" data-aos="fade-down" data-aos-easing="linear"
                data-aos-duration="1500">
                {!! $home_page_data['experience_education_heading'] !!}
            </p>
            <div class="mb-20" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                {!! $home_page_data['experience_education_description'] !!}
            </div>
            <p class="hd-20 fw-medium text-left mb-20 text-capitalize" data-aos="fade-down" data-aos-easing="linear"
                data-aos-duration="1500">
                {!! $home_page_data['compensation_heading'] !!}
            </p>
            <div class="mb-20" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                {!! $home_page_data['compensation_description'] !!}
            </div> 
            <p class="hd-20 fw-medium text-left mb-20 text-capitalize" data-aos="fade-down" data-aos-easing="linear"
                data-aos-duration="1500">
                {!! $home_page_data['to_apply_heading'] !!}
            </p>
            <div class="mb-20" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                {!! $home_page_data['to_apply_description'] !!}
            </div>
        </div>
    </section>
@endsection
