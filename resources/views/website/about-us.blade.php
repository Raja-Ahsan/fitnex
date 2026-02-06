@extends('layouts.website.master')
@section('title', $page_title)
@section('content')

<style>
    :root {
        --primary-color: #00A3FF;
        --text-color: #e0e0e0;
    }

    body {
        background-color: #000;
        color: var(--text-color);
    }

    .primary-theme-bg {
        background-color: #00A3FF; /* Your primary theme color */
    }
    .primary-theme-text {
        color: #00A3FF; /* Your primary theme color */
    }

    .about-template-section {
        padding: 60px 0;
    }

    .about-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 40px;
    }

    .about-col {
        flex: 1 1 45%;
        max-width: 45%;
    }

    .image-glow-container {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-glow-container::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 12px;
        padding: 2px;
        background: linear-gradient(45deg, var(--primary-color), #333);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        z-index: 1;
    }

    .image-glow-container img {
        border-radius: 10px;
        width: 100%;
        /* max-width: 500px; */
        height: auto;
        display: block;
    }

    .text-content .section-title {
        font-size: 3.5rem;
        font-weight: 500;
        text-transform: uppercase;
        margin-bottom: 20px;
        color: #fff;
    }

    .text-content .section-title span {
        color: var(--primary-color);
    }

    .text-content p {
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .mission-list {
        list-style: none;
        padding-left: 0;
    }

    .mission-list li {
        position: relative;
        padding-left: 35px;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .mission-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        top: 0;
        color: var(--primary-color);
        font-size: 1.5rem;
        font-weight: bold;
    }

    @media screen and (max-width: 991px) {
        .about-col {
            flex: 1 1 100%;
            max-width: 100%;
            text-align: center;
        }
        .text-content {
            padding-top: 20px;
        }
    }
</style>

<!-- Banner Section -->
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

<!-- WHO WE ARE -->
<section class="about-template-section">
    <div class="container">
        <div class="about-row">
            <div class="about-col" data-aos="fade-right">
                @if (isset($page_data['about_us_image']))
                    <div class="image-glow-container">
                        <img src="{{ asset('/admin/assets/images/page/' . $page_data['about_us_image']) }}" alt="Who We Are">
                    </div>
                @endif
            </div>
            <div class="about-col" data-aos="fade-left">
                <div class="text-content">
                    <h2 class="section-title">Who <span>We</span> Are</h2>
                    <p>{{ $page_data['about_description'] ?? '' }}</p>
                    <p>{{ $page_data['about_description_two'] ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR APPROACH -->
<section class="about-template-section">
    <div class="container">
        <div class="about-row" style="flex-direction: row-reverse;">
            <div class="about-col" data-aos="fade-left">
                @if (isset($page_data['about_us_image2']))
                    <div class="image-glow-container">
                        <img src="{{ asset('/admin/assets/images/page/' . $page_data['about_us_image2']) }}" alt="Our Approach">
                    </div>
                @endif
            </div>
            <div class="about-col" data-aos="fade-right">
                <div class="text-content">
                    <h2 class="section-title">Our <span>Approach</span></h2>
                    <p>{{ $page_data['about_description_three'] ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR MISSION -->
<section class="about-template-section">
    <div class="container">
        <div class="about-row">
            <div class="about-col" data-aos="fade-right">
                @if (isset($page_data['why_image']))
                    <div class="image-glow-container our-mission-image">
                        <img src="{{ asset('/admin/assets/images/page/' . $page_data['why_image']) }}" alt="Our Mission">
                    </div>
                @endif
            </div>
            <div class="about-col" data-aos="fade-left">
                <div class="text-content">
                    <h2 class="section-title">Our <span>Mission</span></h2>
                    <p>{{ $page_data['our_mission_description'] ?? '' }}</p>
                    <p>{{ $page_data['first_description'] ?? '' }}</p>
                    <ul class="mission-list">
                        @foreach (['first', 'second', 'third', 'fourth'] as $key)
                            @if (!empty($page_data["{$key}_our_mission_description"]))
                                <li>{{ $page_data["{$key}_our_mission_description"] }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

