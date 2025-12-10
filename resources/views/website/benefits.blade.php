@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
@if(!empty($banner->image))
<section class="inner-banner benefits-banner" style="background-image: url('{{asset('/admin/assets/images/banner') }}/{{ $banner->image }}');"> 
@else
<section class="inner-banner benefits-banner" style="background-image: url('{{asset('/admin/assets/images/images.png') }}');" style="width:100%">
@endif
  <div class="banner-wrapper position-relative z-1">
    <div class="container">
      <div class="row">
        @include('website.include.social-links') 
        <div class="col-lg-7 col-xl-6" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
          <div class="card">
            <div class="shape-1"></div>
              @if(isset($banner))
                <h1 class="hd-70">{{$banner->name}}</h1> 
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
<section class="benefit-sec-2 py-150" id="sec-1">
  <div class="container">
    <h2 class="hd-70 heading mb-20 text-center" data-aos="flip-left"
     data-aos-easing="linear"
     data-aos-duration="1500">
      <span class="text-primary-theme text-center text-capitalize">Member</span> <span>Benefits</span>
    </h2>
    <p class="hd-42 fw-semibold text-center mb-50" data-aos="fade-up"
     data-aos-easing="linear"
     data-aos-duration="1500">
      We promote, connect, and advocate for all local businesses within our Area.
    </p>
  </div>
  <div class="row">
    <div class="slider-wrapper">
      <div class="infinite-slider">
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-01.png" alt="">
        </div>
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-02.png" alt="">
        </div>
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-03.png" alt="">
        </div>
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-04.png" alt="">
        </div>
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-05.png" alt="">
        </div>
        <!-- Duplicate the content -->
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-01.png" alt="">
        </div>
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-02.png" alt="">
        </div>
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-03.png" alt="">
        </div>
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-04.png" alt="">
        </div>
        <div>
          <img src="{{ asset('/assets/website') }}/images/sl-md-05.png" alt="">
        </div>
      </div>
    </div>
  </div>
</section>
<section class="benefit-sec-3">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6" data-aos="fade-right"
     data-aos-easing="linear"
     data-aos-duration="1500">
        <h2 class="text-uppercase hd-42 heading mb-20">How we serve <span>our members:</span></h2>
        <p class="hd-20 fw-medium mb-20 text-capitalize lh-base">
          <span class="fw-bold">Share industry intelligence so you can plan for current and future business opportunities</span>.Timely insights and projections will help position you to submit effective proposals. 
        </p>
        <p class="hd-20 fw-medium text-capitalize mb-20">
          <span class="fw-bold">Display your business name, logo, description, and contact information listed in the FITNEX directory.</span> Contractors, especially ones from out of state, need a single source of information to fill their positions and find the goods, supplies, and services they need. Our comprehensive directory is a trusted source for reliable, affordable, and reputable businesses.
        </p>
        <p class="hd-20 fw-medium mb-20 text-capitalize">
          <span class="fw-bold">Connect you directly with contractors</span>. Have a new service offer or novel business opportunity? Through FITNEX, you can connect and network directly with local, national, and international businesses to expand, innovate, and find business partners.
        </p>
        <p class="hd-20 fw-medium text-capitalize">
          <span class="fw-bold">Establish your reputation</span>. Grow your reach and name recognition in our area and across the nation.
        </p>
      </div>
      <div class="col-lg-5" data-aos="fade-left"
     data-aos-easing="linear"
     data-aos-duration="1500">
        <div class="position-relative">
          <div class="img-wrapper md-shape">
            <img src="{{ asset('/assets/website') }}/images/about-01.png" class="" alt="our members">
          </div>
          <div class="position-absolute sm-img-wrapper">
            <img src="{{ asset('/assets/website') }}/images/about-01.png" alt="our members">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection