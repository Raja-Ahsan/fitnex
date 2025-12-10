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

<section class="trainer-details-sec py-[50px] md:py-[100px] bg-black text-white">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-x-12 items-center">
            <div class="lg:col-span-2 trainer-image-box" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1500">
                <img src="{{ asset('/admin/assets/images/Trainers/'.$trainer->image) }}" alt="{{ $trainer->name }}" class="rounded-lg trainer-details-img">
            </div>
            <div class="lg:col-span-3 trainer-info-box" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1500">
                <h2 class="text-4xl font-bold font-secondary">{{ $trainer->name }}</h2>
                <p class="text-xl text-[#0079D4] font-secondary mb-4">{{ $trainer->designation }}</p>
                @if($trainer->city && $trainer->state)
                <p class="text-white">
                    <i class="fa-solid fa-location-dot mb-4 text-[#0079D4] mr-2"></i>{{ $trainer->city }}, {{ $trainer->state }}
                </p>
                @endif
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        @for ($i = 0; $i < $trainer->rating; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                        @for ($i = 0; $i < 5 - $trainer->rating; $i++)  
                            <i class="fa-regular fa-star"></i>
                        @endfor
                    </div>
                    <span class="ml-2 text-white">({{ number_format($trainer->rating, 1) }}/5.0)</span>
                </div>
               
                <p class="para para-white mb-6">
                    {!! $trainer->description !!}
                </p>
                <h3 class="text-2xl font-bold font-secondary mb-3">Specialties:</h3>
                <ul class="list-disc list-inside space-y-2 mb-6">
                    @php
                        $specializations = json_decode($trainer->specialization, true);
                    @endphp
                    @if (!empty($specializations))
                        @foreach ($specializations as $spec)
                            <li>{{ $spec }}</li>
                        @endforeach
                    @endif
                </ul>
                <h3 class="text-2xl font-bold font-secondary mb-3">Training Type:</h3>
                <p class="text-white mb-4">{{ $trainer->trainer_type }}</p>
                <h3 class="text-2xl font-bold font-secondary mb-3">Contact:</h3>
                <div class="text-white space-y-2 mb-6">
                    @if($trainer->email)
                    <p><i class="fa-solid fa-envelope text-[#0079D4] mr-2"></i><a href="mailto:{{ $trainer->email }}" class="text-white hover:text-[#0079D4]">{{ $trainer->email }}</a></p>
                    @endif
                    @if($trainer->phone)
                    <p><i class="fa-solid fa-phone text-[#0079D4] mr-2"></i><a href="tel:{{ $trainer->phone }}" class="text-white hover:text-[#0079D4]">{{ $trainer->phone }}</a></p>
                    @endif
                    @if($trainer->instagram)
                    <p><i class="fa-brands fa-instagram text-[#0079D4] mr-2"></i><a href="{{ $trainer->instagram }}" target="_blank" class="text-white hover:text-[#0079D4]">{{ $trainer->instagram }}</a></p>
                    @endif
                </div>  
                <div class="flex items-center justify-between">
                    <p class="text-3xl font-bold font-secondary"><span class="primary-theme">${{ $trainer->price }}</span> <span class="text-base font-normal">/ session</span></p>
                    
                    <a href="{{ route('appointments.create', ['trainer_id' => $trainer->id]) }}" class="btn primary-btn">Book a Session</a> 
                </div>
            </div>
        </div>
    </div>
</section>
@endsection