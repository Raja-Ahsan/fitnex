@extends('layouts.website.master')

@section('title', $page_title)

@section('content')
<style>
    .job-details-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 32px 24px;
        margin-bottom: 32px;
    }
    .jobpost-img {
        width: 100%;
        border-radius: 12px;
        object-fit: cover;
        max-height: 350px;
        margin-bottom: 20px;
    }
    .list-tit h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #004B87;
        margin-bottom: 10px;
    }
    .dpan-des span {
        font-size: 1.1rem;
        color: #555;
    }
    .general-content h3 {
        font-size: 1.3rem;
        color: #004B87;
        margin-bottom: 10px;
    }
    .general-content p {
        color: #444;
        font-size: 1.05rem;
    }
    .agent-listbox {
        background: #f8f9fa;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        padding: 24px 18px;
        margin-bottom: 32px;
        text-align: center;
    }
    .box-img img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .agent-des h3 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #004B87;
        margin-bottom: 2px;
    }
    .agent-des h6 {
        color: #888;
        font-size: 1rem;
        margin-bottom: 0;
    }
    .agent-contact {
        background: #fff;
        border-radius: 10px;
        padding: 18px 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-top: 18px;
    }
    .agent-contact h5 {
        color: #004B87;
        font-size: 1.1rem;
        margin-bottom: 12px;
    }
    .btn-cont {
        background: #004B87;
        color: #fff;
        border-radius: 6px;
        padding: 8px 24px;
        font-weight: 600;
        border: none;
        transition: background 0.2s;
    }
    .btn-cont:hover {
        background: #003666;
        color: #fff;
    }
    .rent-listing {
        background: #f4f7fa;
        border-radius: 16px;
        padding: 32px 0 24px 0;
        margin-top: 50px;
        margin-bottom: 50px;
    }
    .rental-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        padding: 18px 12px;
        margin: 0 8px;
        text-align: center;
        transition: box-shadow 0.2s;
    }
    .rental-box:hover {
        box-shadow: 0 6px 24px rgba(0,75,135,0.13);
    }
    .pack-image-box img {
        width: 100%;
        border-radius: 10px;
        max-height: 120px;
        object-fit: cover;
        margin-bottom: 10px;
    }
    .pack-rent-content h3 {
        font-size: 1.1rem;
        color: #004B87;
        font-weight: 600;
        margin-bottom: 6px;
    }
    .pack-rent-content p {
        color: #666;
        font-size: 0.98rem;
        margin-bottom: 4px;
    }
    .rent-foot .uni-btn {
        background: #F7A823;
        color: #fff;
        border-radius: 5px;
        padding: 6px 18px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }
    .rent-foot .uni-btn:hover {
        background: #004B87;
        color: #fff;
    }
    .listing-sec {
        margin-top: 50px;
        margin-bottom: 50px;
    }
</style>

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

<section class="listing-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="job-details-card">
                    <div class="listing-slide-img">
                        @if($jobpost->image)
                        <img src="{{ asset('/admin/assets/images/jobpost/' . $jobpost->image) }}" class="jobpost-img" alt="">
                        @else
                        <img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}" class="jobpost-img">
                        @endif
                    </div>
                    <div class="list-tit">
                        <h3>{{ $jobpost->name }}</h3>
                    </div>
                    <div class="dpan-des">
                        <span>{!! $jobpost->short_description !!}</span>
                    </div>
                    <div class="general-content mt-5">
                        <h3>Description</h3>
                        <p>{!! $jobpost->description !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="agent-listbox">
                    <div class="box-head">
                        <div class="box-img">
                            @if($contractor_detail && $contractor_detail->image)
                            <img src="{{ asset('/admin/assets/images/UserImage/' . $contractor_detail->image) }}" class="img-fluid">
                            @else
                            <img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}" class="img-fluid">
                            @endif
                        </div>
                        <div class="agent-des">
                            @if($contractor_detail)
                            <h3>{{ $contractor_detail->name }} {{ $contractor_detail->last_name }}</h3>
                            <h6>{{ $contractor_detail->designation }}</h6>
                            @else
                            <p>Contractor details not available.</p>
                            @endif
                        </div>
                    </div>
                    <div class="agent-contact mt-3">
                        <h5>Contact For Contractor</h5>
                        <form action="{{ route('client_contact.store') }}" id="contactForm" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="agent_id" value="{{ $contractor_detail->id }}" required>
                                {{-- <input type="hidden" name="property_id" value="{{ $jobpost->id }}" required> --}}
                                <div class="row">
                                    <div class="col-6">
                                        <input type="phone" class="form-control mb-2" name="phone" placeholder="Phone" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="email" class="form-control mb-2" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" name="message" placeholder="Your Comments" rows="4" required></textarea>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-cont">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if(Session::has('message'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ Session::get('message') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related jobposts Section -->
<section class="rent-listing mt-5">
    <div class="container">
        <h2>Related Job Posts</h2>
        <div class="row">
            <div class="wrapper d-flex flex-wrap">
                <div class="carousel-img d-flex flex-wrap">
                    @foreach($related_jobposts as $related_jobpost)
                    <div class="slick-slide" style="flex: 0 0 250px; max-width: 250px;">
                        <div class="rental-box">
                            <div class="pack-image-box">
                                @if($related_jobpost->image)
                                <img src="{{ asset('/admin/assets/images/jobpost/' . $related_jobpost->image) }}" class="jobpost-image" alt="{{ $related_jobpost->name }}">
                                @else
                                <img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}">
                                @endif
                            </div>
                            <div class="pack-rent-content">
                                <h3>{{ $related_jobpost->name }}<br></h3>
                                <p>{{ Str::words($related_jobpost->short_description, 10, '...') }}</p>
                                <p>{!! Str::words(strip_tags($related_jobpost->description), 10, '...') !!}</p>
                            </div>
                            <div class="rent-foot">
                                <a href="{{ route('jobpost.details', $related_jobpost->id) }}" class="uni-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection