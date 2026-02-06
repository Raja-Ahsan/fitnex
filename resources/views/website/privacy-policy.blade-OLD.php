@extends('layouts.website.master')
@section('title', $page_title)
@section('content')

<!-- ======= Hero Section ======= -->
<section id="inner-hero" class="d-flex justify-cntent-center align-items-center">
  <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">
    <div class="carousel-item active">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown">{!! $home_page_data['privacy_heading'] !!}</h2>
      </div>
    </div>

  </div>
</section><!-- End Hero -->

<!-- ======= Privacy Policy Section ======= -->
<section id="about" class="about">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>{!! $home_page_data['privacy_heading'] !!}</h2>
    </div>
    <div class="row content">
      <div class="col-lg-12">
        <p>{!! $home_page_data['privacy_content'] !!}</p>
      </div>
</section>
<!-- End Privacy Policy Section -->
@endsection