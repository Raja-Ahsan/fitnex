@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
<style>
    .primary-theme-text {
        color: #00A3FF !important; /* Your primary theme color */
    }
</style>
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

<div id="cursor-card" class="fixed top-0 left-0 w-64 bg-primary-theme text-white p-4 rounded-lg shadow-2xl pointer-events-none z-50 opacity-0 scale-0 transform-gpu" style="transform-origin: center center;">
  <!-- <img id="cursor-card-img" src="" alt="" class="w-full h-40 object-cover rounded-t-lg"> -->
  <div class="p-4">
      <h3 id="cursor-card-title" class="text-xl font-bold text-white mb-[10px]"></h3>
      <p id="cursor-card-description" class="text-sm text-white"></p>
      <span id="cursor-card-price" class="text-sm text-white font-bold"></span>
  </div>
</div>
<section class="expert-trainers-sec relative bg-black py-[50px] md:py-[100px]">
  <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('/assets/website/images/expert-trainer-listing-bg.jpg') }}');"></div>
  <div class="absolute inset-0 bg-black opacity-70"></div>

  <div class="container mx-auto px-4 relative z-10">
      <div class="text-center mb-12">
          <h3 class="sec-hd"
              data-aos="flip-right"
              data-aos-easing="linear"
              data-aos-duration="1500">Expert Trainers</h3>
          <p class="para para-white max-w-[490px] mx-auto"
              data-aos="fade-right"
              data-aos-easing="linear"
              data-aos-duration="1500">Achieve your fitness goals with our experienced
              and passionate trainers at strong. </p>
      </div>

      <div class="">
          <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-16 justify-items-center max-w-5xl mx-auto">
              <!-- replace all twitter icons with fa-brands fa-x-twitter -->
              @foreach ($trainers as $trainer)
                <div class="trainer-card flex"
                    data-title="{{ $trainer->trainer_type }}"
                    data-description="{{ $trainer->description }}"
                    data-price="Price: ${{ $trainer->price }}"
                    data-aos="flip-right"
                    data-aos-easing="linear"
                    data-aos-duration="1500">
                    <a href="{{ route('trainer.detail', $trainer->id) }}" class="no-underline">
                        <div class="relative overflow-hidden rounded-lg h-[450px] w-[300px] flex-shrink-0"> 
                            @if($trainer->image)
                                <img src="{{ asset('/admin/assets/images/Trainers/'.$trainer->image ) }}" class="w-full h-full object-cover object-top" alt="{{ $trainer->name }}">
                            @else
                                <img src="{{ asset('/admin/assets/images/Trainers/no-photo1.jpg') }}" class="w-full h-full object-cover object-top" alt="{{ $trainer->name }}">
                            @endif
                            <div class="absolute top-5 left-5 flex flex-col space-y-2 social-media-links">
                                <a href="{{ $trainer->twitter }}" class="bg-white text-black w-8 h-8 rounded-md flex justify-center items-center no-underline transition-all duration-300 expoert-traning-card hover:text-white hover:scale-110"><i class="fab fa-x-twitter"></i></a>
                                <a href="{{ $trainer->instagram }}" class="bg-white text-black w-8 h-8 rounded-md flex justify-center items-center no-underline transition-all duration-300 expoert-traning-card hover:text-white hover:scale-110"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="text-rotate">
                    <h4>{{ $trainer->name }}</h4>
                    <span>{{ $trainer->trainer_type }}</span>
                </div>
                @endforeach
                
          </div>
      </div>
  </div>
</section>

@endsection