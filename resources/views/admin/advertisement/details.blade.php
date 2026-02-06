@extends('layouts.website.master')

@section('title', $page_title)

@section('content')

<!-- ======= Hero Section ======= -->
<section id="inner-hero" class="d-flex justify-content-center align-items-center">
    <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">
        <div class="carousel-item active">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">Advertisement Details</h2>
            </div>
        </div>
    </div>
</section>
<!-- End Hero -->
<section class="listing-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="wrapper">
                    <div class="listing-detail-box">
                        <div class="listing-slide-img">
                            @if($advertisement->image)
                            <img src="{{ asset('/admin/assets/images/advertisement/' . $advertisement->image) }}" class="advertisement-img" alt="">
                            @else
                            <img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}" class="advertisement-img">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row title">
                    <div class="col-md-7">
                        <div class="list-tit">
                            <h3>{{ $advertisement->name }}</h3>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="dpan-des">
                            <span>{!! $advertisement->short_description !!}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 general-content mt-5">
                        <h3> Description</h3>
                        <p>{!! $advertisement->description !!}</p>
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
                                <input type="hidden" name="property_id" value="{{ $advertisement->id }}" required>
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
                                        <button type="submit" class="btn btn-warning btn-cont">Submit</button>
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


<!-- Related Advertisements Section -->
<section class="rent-listing mt-5">
    <div class="container">
        <h2>Related Advertisements</h2>
        <div class="row">
            <div class="wrapper">
                <div class="carousel-img">
                    @foreach($related_advertisements as $related_advertisement)
                    <div class="slick-slide">
                        <div class="rental-box">
                            <div class="pack-image-box">
                                @if($related_advertisement->image)
                                <img src="{{ asset('/admin/assets/images/advertisement/' . $related_advertisement->image) }}" class="advertisement-image" alt="{{ $related_advertisement->name }}">
                                @else
                                <img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}">
                                @endif
                                <div class="rent-header">
                                    <!--   <div class="rent-featured"><span>Featured</span></div>
                                    <div class="rent-offers"><span>Rentals</span><span class="offer">New Offer</span></div> -->
                                </div>
                            </div>
                            <div class="pack-rent-content">
                                <h3>{{ $related_advertisement->name }}<br></h3>
                                <!-- <p>{{ $advertisement->short_description }}</p>
                                    <p>{!! $advertisement->description !!}</p> -->
                                <p>{{ Str::words($related_advertisement->short_description, 10, '...') }}</p>
                                <p>{!! Str::words(strip_tags($related_advertisement->description), 10, '...') !!}</p>
                            </div>
                            <div class="rent-foot">
                                <a href="{{ route('advertisement.details', $related_advertisement->id) }}" class="uni-btn">Read More</a>
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