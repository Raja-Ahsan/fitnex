@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
    <style>
        .primary-theme-text {
            color: #00A3FF !important;
        }
    </style>
    <section class="inner-banner listing-banner"
        style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/' . $banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
        <div class="container px-4 sm:px-6">
            <h1 class="relative mx-auto text-3xl sm:text-4xl md:text-[50px] text-white font-bold leading-[1.1] text-center" {{-- data-aos="flip-right" data-aos-easing="linear" data-aos-duration="500" --}}>
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

    <div id="cursor-card"
        class="fixed top-0 left-0 w-64 bg-primary-theme text-white p-4 rounded-lg shadow-2xl pointer-events-none z-50 opacity-0 scale-0 transform-gpu"
        style="transform-origin: center center;">
        <div class="p-4">
            <h3 id="cursor-card-title" class="text-xl font-bold text-white mb-[10px]"></h3>
            <p id="cursor-card-description" class="text-sm text-white"></p>
            <span id="cursor-card-price" class="text-sm text-white font-bold"></span>
        </div>
    </div>

    <section class="expert-trainers-sec relative bg-black py-10 sm:py-14 md:py-16 lg:py-20 xl:py-24 overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('/assets/website/images/expert-trainer-listing-bg.jpg') }}');"></div>
        <div class="absolute inset-0 bg-black/70"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-8 sm:mb-10 md:mb-12">
                <h3 class="sec-hd text-2xl sm:text-3xl md:text-4xl mb-2 sm:mb-3" {{-- data-aos="flip-right" data-aos-easing="linear" data-aos-duration="500" --}}>Expert Trainers</h3>
                @if(isset($selectedCategory) && $selectedCategory)
                    <p class="para para-white max-w-[490px] mx-auto  text-sm sm:text-base md:text-lg px-2" {{-- data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500" --}}>
                        Showing: <span class="primary-theme font-bold">{{ $selectedCategory->title }}</span>@if(!empty($selectedDelivery ?? null))<span class="text-white"> — {{ ($selectedDelivery === 'online') ? 'Online' : 'In-person' }} sessions</span>@endif
                    </p>
                    
                @elseif(!empty($noTrainersAvailable))
                    <p class="para para-white max-w-[490px] mx-auto mb-2 text-sm sm:text-base md:text-lg px-2" {{-- data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500" --}}>
                        No trainers available for this service.
                    </p>
                    <a href="{{ route('trainers') }}" class="inline-block mt-2 text-sm text-gray-400 hover:text-white underline">View all professionals</a>
                @else
                    <p class="para para-white max-w-[490px] mx-auto text-sm sm:text-base md:text-lg px-2" {{-- data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500" --}}>
                        Achieve your fitness goals with our experienced and passionate trainers at Fitnex.
                    </p>
                @endif
            </div>

            @if(!empty($noTrainersAvailable))
            <div class="text-center py-12 sm:py-10">
                <p class="para para-white text-base sm:text-lg md:text-xl max-w-xl mx-auto mb-6">
                    No trainers are currently available for this service. Use the link above to view all our professionals.
                </p>
                <a href="{{ route('trainers') }}" class="btn primary-btn border border-transparent text-sm sm:text-base py-3 px-5 sm:px-6 md:px-8 min-h-[44px] inline-flex items-center justify-center">View all professionals</a>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 justify-items-center max-w-6xl mx-auto">
                @foreach ($trainers as $trainer)
                <div class="trainer-card expert-trainer-item flex flex-col items-center w-full max-w-[280px] sm:max-w-[300px] lg:max-w-[320px]"
                    data-title="{{ $trainer->trainer_type_display }}"
                    data-description="{{ $trainer->description }}"
                    data-price="Price: ${{ $trainer->price }}"
                    {{-- data-aos="fade-up" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="{{ $loop->index * 50 }}" --}}>
                    <a href="{{ route('trainer.detail', $trainer->id) }}" class="trainer-card-link block w-full no-underline group">
                        <div class="relative w-full overflow-hidden rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl bg-neutral-800" style="aspect-ratio: 3/4;">
                            @if($trainer->image)
                                <img src="{{ asset('/admin/assets/images/UserImage/'.$trainer->image) }}"
                                    class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-105" alt="{{ $trainer->name }}" loading="lazy">
                            @else
                                <img src="{{ asset('/admin/assets/images/trainers/no-photo1.jpg') }}"
                                    class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-105" alt="{{ $trainer->name }}" loading="lazy">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3 sm:p-4 md:p-5">
                                <p class="text-white/95 text-xs sm:text-sm font-medium mb-0.5 sm:mb-1">{{ $trainer->trainer_type_display }}</p>
                                <p class="text-white text-[10px] sm:text-xs line-clamp-2 sm:line-clamp-3 mb-2 sm:mb-3">{{ Str::limit($trainer->description, 100) }}</p>
                                <p class="text-white font-bold text-sm sm:text-base mb-2 sm:mb-3">From ${{ $trainer->price }}</p>
                                <span class="inline-flex items-center gap-1.5 text-white font-semibold text-xs sm:text-sm">View profile <i class="fas fa-arrow-right text-[10px] sm:text-xs"></i></span>
                            </div>
                            @if(!empty($trainer->twitter) || !empty($trainer->instagram))
                                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 flex flex-col gap-1.5 sm:gap-2 social-media-links z-10">
                                    @if(!empty($trainer->twitter))
                                        <a href="{{ $trainer->twitter }}" target="_blank" rel="noopener noreferrer" class="bg-white/90 text-black w-8 h-8 sm:w-9 sm:h-9 rounded-lg flex justify-center items-center no-underline transition-all duration-300 hover:bg-[var(--primary-theme)] hover:text-white active:scale-95" onclick="event.stopPropagation();" aria-label="Twitter"><i class="fab fa-x-twitter text-sm sm:text-base"></i></a>
                                    @endif
                                    @if(!empty($trainer->instagram))
                                        <a href="{{ $trainer->instagram }}" target="_blank" rel="noopener noreferrer" class="bg-white/90 text-black w-8 h-8 sm:w-9 sm:h-9 rounded-lg flex justify-center items-center no-underline transition-all duration-300 hover:bg-[var(--primary-theme)] hover:text-white active:scale-95" onclick="event.stopPropagation();" aria-label="Instagram"><i class="fab fa-instagram text-sm sm:text-base"></i></a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="trainer-card-label mt-3 sm:mt-4 text-center w-full px-0.5 sm:px-1 min-w-0">
                        <div class="border-t-2 sm:border-t-4 border-[var(--primary-theme)] pt-3 sm:pt-4">
                            <h4 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-[var(--primary-theme)] leading-tight break-words">{{ $trainer->name }}</h4>
                            <span class="text-xs sm:text-sm md:text-base lg:text-lg font-semibold text-white/90 block mt-1 sm:mt-1.5 break-words">{{ $trainer->trainer_type_display }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
@endsection