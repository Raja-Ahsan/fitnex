@extends('layouts.website.master')
@section('title', $page_title)
@section('content')

<section class="hero-banner swiper">
    <div class="swiper-wrapper">
        @foreach ($homesliders as $homeslider) 
        <div class="swiper-slide h-full flex items-center justify-center" style="background: url('{{ asset('/admin/assets/images/HomeSlider/' . ($homeslider->image ? $homeslider->image : 'no-photo1.jpg')) }}') no-repeat top/cover;">
            <div class="container">
                <div class="flex justify-center items-center flex-col text-center py-[200px]">
                    @if($homeslider->title) 
                        <div class="label-area c" {{-- data-aos="fade-down"
                            data-aos-easing="linear"
                            data-aos-duration="1500" --}}>
                            {{ $homeslider->title }}
                        </div> 
                    @endif  
                    <div>
                        @if($homeslider->heading) 
                            <h1 class="relative text-[50px] md:text-[70px] lg:text-[80px] xxl:text-[100px] text-white font-bold leading-[1.1] lg:max-w-[680px] xxl:max-w-[860px]"
                                {{-- data-aos="flip-right"
                                data-aos-easing="linear"
                                data-aos-duration="1500" --}}> 
                                {!! formatFitnexText($homeslider->heading) !!}
                            </h1>
                        @endif 
                        @if($homeslider->description) 
                            <div class="text-white font-secondary  text-[20px] mx-auto mb-[20px] max-w-[600px]" {{-- data-aos="fade-right"
                                data-aos-easing="linear"
                                data-aos-duration="1500" --}}>
                                {!! $homeslider->description !!}
                            </div>
                        @endif 
                        <div class="flex justify-center gap-4 flex-wrap" {{-- data-aos="fade-up"
                            data-aos-easing="linear"
                            data-aos-duration="1500" --}}>
                            <a href="{{ route('trainers') }}" class="btn primary-btn border border-transparent">Find a Wellness Professional <span class="ps-[10px]"><i class="fa-solid fa-arrow-right"></i></span></a>
                            <a href="{{ route('registration') }}" class="btn primary-btn border border-transparent">Join as a Coach <span class="ps-[10px]"><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="custom-slider bg-black pb-[150px] relative z-[1]">
    <ul class="slider-01 bg-white py-[30px]">
        <li class="">
            <span class="text-black">Personal Training</span>
            <div class="md-circle bg-black"></div>
        </li>
        <li class="">
            <span class="text-black">Personal Training</span>
            <div class="md-circle bg-black"></div>
        </li>
        <li class="">
            <span class="text-black">Personal Training</span>
            <div class="md-circle bg-black"></div>
        </li>
        <li class="">
            <span class="text-black">Personal Training</span>
            <div class="md-circle bg-black"></div>
        </li>
        <li class="">
            <span class="text-black">Personal Training</span>
            <div class="md-circle bg-black"></div>
        </li>
        <li class="">
            <span class="text-black">Personal Training</span>
            <div class="md-circle bg-black"></div>
        </li>
        <li class="">
            <span class="text-black">Personal Training</span>
            <div class="md-circle bg-black"></div>
        </li>
        <li class="">
            <span class="text-black">Personal Training</span>
            <div class="md-circle bg-black"></div>
        </li>
    </ul>
    <ul class="slider-02 bg-primary-theme py-[30px] flex justify-between" dir="rtl">
        <li class="">
            <span class="text-white">Nutrition Coaching</span>
            <div class="md-circle bg-white"></div>
        </li>
        <li class="">
            <span class="text-white">Nutrition Coaching</span>
            <div class="md-circle bg-white"></div>
        </li>
        <li class="">
            <span class="text-white">Nutrition Coaching</span>
            <div class="md-circle bg-white"></div>
        </li>
        <li class="">
            <span class="text-white">Nutrition Coaching</span>
            <div class="md-circle bg-white"></div>
        </li>
        <li class="">
            <span class="text-white">Nutrition Coaching</span>
            <div class="md-circle bg-white"></div>
        </li>
        <li class="">
            <span class="text-white">Nutrition Coaching</span>
            <div class="md-circle bg-white"></div>
        </li>
        <li class="">
            <span class="text-white">Nutrition Coaching</span>
            <div class="md-circle bg-white"></div>
        </li>
        <li class="">
            <span class="text-white">Nutrition Coaching</span>
            <div class="md-circle bg-white"></div>
        </li>
    </ul>
</section>
<section class="our-services bg-black">
    <div class="container">
        <h2 class="sec-hd text-center mb-[10px]"
            {{-- data-aos="flip-right"
            data-aos-easing="linear"
            data-aos-duration="1500" --}}>our services</h2>
        <p class="para text-center max-w-[490px] mx-auto para-white mb-[30px]"
            {{-- data-aos="fade-right"
            data-aos-easing="linear"
            data-aos-duration="1500" --}}>
            Strong offers 5 popular services to help you make
            comfortable choices that suit your needs.
        </p>
    </div>
    <div class="grid grid-cols-1 justify-items-center md:grid-cols-3 lg:grid-cols-5 gap-y-[20px]">
        @foreach ($categories as $category)
        <div>
            <a href="{{ route('trainers', ['category' => $category->slug]) }}" class="block no-underline">
            <div class="our-services-item relative cursor-pointer" style="height: 100%"
                {{-- data-aos="fade-up"
                data-aos-duration="600"
                data-aos-delay="{{ $loop->index * 100 }}" --}}
                >
                <img src="{{ asset('/admin/assets/images/services/'.$category->image) }}" class="relative z-[1] h-full w-auto mx-auto" alt="">
                <div class="our-services-content">
                    <h4 class="">
                        {{ $category->title }}
                    </h4>
                </div>
            </div>
            </a>
        </div>
        @endforeach 
    </div>
</section>
<section class="fitness-journey bg-black py-[50px] md:py-[100px]">
    <div class="container">
        <h2 class="sec-hd text-center mb-[10px] max-w-[670px] mx-auto"
            {{-- data-aos="flip-right"
            data-aos-easing="linear"
            data-aos-duration="1500" --}}>
            let's Transform Your
            Fitness Journey
        </h2>
        <p class="para text-center max-w-[490px] mx-auto para-white mb-[80px]"
            {{-- data-aos="fade-right"
            data-aos-easing="linear"
            data-aos-duration="1500" --}}>
            10 years of experience in the fitness industry.
        </p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 justify-between items-center max-w-[1000px] mx-auto mb-[40px]"
        {{-- data-aos="fade-down"
        data-aos-easing="linear"
        data-aos-duration="1500" --}}>
        <div class="text-center">
            <h4 class="text-[48px] font-bold primary-theme count" data-number="0">
                0
            </h4>
            <p class="text-white font-secondary text-[20px]">
                Clients
            </p>
        </div>
        <div class="text-center">
            <h4 class="text-[48px] font-bold primary-theme count" data-number="{{ $trainers->count() }}">
                {{ $trainers->count() }}
            </h4>
            <p class="text-white font-secondary text-[20px]">
                Expert Trainers
            </p>
        </div>
       
        <div class="text-center">
            <h4 class="text-[48px] font-bold primary-theme count" data-number="10">
                10
            </h4>
            <p class="text-white font-secondary text-[20px]">
                Year of experience
            </p>
        </div>
    </div>
    <div class="fitness-journey-slider">
        <div>
            <img src="{{ asset('/assets/website/images/journey-01.png') }}" class="w-full h-full object-cover" alt="">
        </div>
        <div>
            <img src="{{ asset('/assets/website/images/journey-02.png') }}" class="w-full h-full object-cover" alt="">
        </div>
        <div>
            <img src="{{ asset('/assets/website/images/journey-03.png') }}" class="w-full h-full object-cover" alt="">
        </div>
    </div>
</section>
@if(isset($home_page_data['about_status']) && $home_page_data['about_status'] == 1)
<section class="about-sec bg-black pb-[50px] md:pb-[100px]">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-[30px]">
            <div class="text-center md:text-start" {{-- data-aos="fade-right"
                data-aos-easing="linear"
                data-aos-duration="1500" --}}>
                <h3 class="sec-hd mb-[20px]">{{ $home_page_data['home_about_title'] }}</h3>
                <div class="para para-white mb-[10px]">
                    {!! $home_page_data['home_about_description'] !!}
                </div>
                <div class="flex justify-center md:justify-start">
                    <a href="{{ route('about-us') }}" class="btn primary-btn">Leann More</a>
                </div>
            </div>
            <div
                {{-- data-aos="fade-left"
                data-aos-easing="linear"
                data-aos-duration="1500" --}}>
                @if(isset($home_page_data['home_about_image']) && $home_page_data['home_about_image'] != '')
                    <img src="{{ asset('/admin/assets/images/page/'.$home_page_data['home_about_image']) }}" class="" alt="">
                @else
                    <img src="{{ asset('/assets/website/images/about-sec-right.png') }}" class="" alt="">
                @endif
            </div>
        </div>
    </div>
</section>
@endif
<div id="cursor-card" class="fixed top-0 left-0 w-64 bg-primary-theme text-white p-4 rounded-lg shadow-2xl pointer-events-none z-50 opacity-0 scale-0 transform-gpu" style="transform-origin: center center;">
    <div class="p-4">
        <h3 id="cursor-card-title" class="text-xl font-bold text-white mb-[10px]"></h3>
        <p id="cursor-card-description" class="text-sm text-white"></p>
        <span id="cursor-card-price" class="text-sm text-white font-bold"></span>
    </div>
</div>
<style>
    .home-trainers-sec {
        --ot-accent: #0079D4;
        --ot-card: #141414;
        --ot-border: rgba(255, 255, 255, 0.1);
        --ot-muted: #a1a1aa;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .home-trainers-sec .trainer-profile-card {
        max-height: none;
        background: var(--ot-card);
        border: 1px solid var(--ot-border);
        border-radius: 14px;
        overflow: hidden;
        transition: border-color 0.25s ease, transform 0.25s ease;
    }

    .home-trainers-sec .trainer-profile-card:hover {
        border-color: rgba(0, 121, 212, 0.45);
        transform: translateY(-3px);
    }

    .home-trainers-sec .trainer-profile-card img {
        transition: transform 0.35s ease;
    }

    .home-trainers-sec .trainer-profile-card:hover img {
        transform: scale(1.04);
    }
</style>

<section class="home-trainers-sec expert-trainers-sec relative bg-[#0a0a0a] py-12 sm:py-16 md:py-20 lg:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 max-w-7xl">
        <div class="text-center mb-10 sm:mb-12 md:mb-14">
            <p class="text-[11px] sm:text-xs tracking-[0.22em] uppercase font-semibold text-[var(--ot-accent)] mb-3">
                Expert Trainers
            </p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">
                Our Trainers
            </h2>
            <div class="w-12 h-[2px] bg-[var(--ot-accent)] mx-auto mb-5"></div>
            <p class="text-[var(--ot-muted)] max-w-xl mx-auto text-sm sm:text-base leading-relaxed px-2">
                Our certified trainers and coaches are here to help you move better, feel stronger, and achieve your goals.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 lg:gap-7 mb-8 sm:mb-10">
            @foreach ($trainers as $trainer)
                @php
                    $role = $trainer->trainer_type_display ?: ($trainer->designation ?: 'Personal Trainer');
                    $bio = trim(strip_tags($trainer->description ?? ''));
                    if ($bio === '') {
                        $bio = 'Passionate about helping you build confidence and achieve peak performance.';
                    }

                    $typeLower = strtolower($role . ' ' . ($trainer->trainer_type ?? ''));
                    $tagIcon = 'fa-dumbbell';
                    $tagLabel = 'STRENGTH • FUNCTIONAL';
                    if (str_contains($typeLower, 'nutrition')) {
                        $tagIcon = 'fa-leaf';
                        $tagLabel = 'NUTRITION • WELLNESS';
                    }
                    if (str_contains($typeLower, 'sport') || str_contains($typeLower, 'performance')) {
                        $tagIcon = 'fa-user';
                        $tagLabel = 'PERFORMANCE • CONFIDENCE';
                    }
                    if (str_contains($typeLower, 'body') || str_contains($typeLower, 'strength')) {
                        $tagIcon = 'fa-dumbbell';
                        $tagLabel = 'STRENGTH • FUNCTIONAL';
                    }
                @endphp

                <article class="trainer-profile-card flex flex-col h-full">
                    <a href="{{ route('trainer.detail', $trainer->id) }}" class="block no-underline group">
                        <div class="relative w-full overflow-hidden bg-neutral-900" style="aspect-ratio: 4/5;">
                            @if($trainer->image)
                                <img src="{{ asset('/admin/assets/images/UserImage/'.$trainer->image) }}"
                                    class="absolute inset-0 w-full h-full object-cover object-center"
                                    alt="{{ $trainer->name }}" loading="lazy">
                            @else
                                <img src="{{ asset('/admin/assets/images/trainers/no-photo1.jpg') }}"
                                    class="absolute inset-0 w-full h-full object-cover object-center"
                                    alt="{{ $trainer->name }}" loading="lazy">
                            @endif
                        </div>
                    </a>

                    <div class="flex flex-col flex-1 px-4 sm:px-5 pt-4 pb-5 text-center">
                        <a href="{{ route('trainer.detail', $trainer->id) }}" class="no-underline">
                            <h3 class="text-lg sm:text-xl font-bold text-[var(--ot-accent)] leading-tight mb-1.5 break-words">
                                {{ $trainer->name }}
                            </h3>
                        </a>
                        <p class="text-white text-sm sm:text-[15px] font-medium mb-3 break-words">
                            {{ $role }}
                        </p>
                        @if(!empty($trainer->gym_name) || !empty($trainer->workplace))
                            <p class="text-[var(--ot-muted)] text-xs mb-2">
                                @if(!empty($trainer->gym_name)){{ $trainer->gym_name }}@endif
                                @if(!empty($trainer->gym_name) && !empty($trainer->workplace)) · @endif
                                @if(!empty($trainer->workplace)){{ $trainer->workplace }}@endif
                            </p>
                        @endif
                        <div class="w-10 h-[2px] bg-[var(--ot-accent)] mx-auto mb-3"></div>
                        <p class="text-[var(--ot-muted)] text-xs sm:text-sm leading-relaxed mb-4 flex-1 line-clamp-3">
                            {{ Str::limit($bio, 120) }}
                        </p>
                        <div class="mt-auto flex items-center justify-center gap-2 text-[10px] sm:text-[11px] tracking-[0.12em] uppercase text-[var(--ot-muted)]">
                            <i class="fas {{ $tagIcon }} text-[var(--ot-accent)] text-xs"></i>
                            <span>{{ $tagLabel }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="flex justify-center w-full">
            <a href="{{ route('trainers') }}"
                class="btn primary-btn border border-transparent text-sm sm:text-base py-3 px-5 sm:px-6 md:px-8 min-h-[44px] inline-flex items-center justify-center">
                View All <span class="ps-2"><i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
    </div>
</section>
{{-- <section class="testimonials-sec bg-black py-[50px] md:py-[100px]">
    <div class="container">
        <h2 class="sec-hd text-center mb-[40px] max-w-[670px] mx-auto"
            >
            What people say
        </h2>
    </div>
    <div class="testimonials-slider">
        @foreach ($testimonials as $testimonial)
        <div class="testimonial-item">
            <div class="flex flex-col md:flex-row">
                <div class="w-full">
                    @if($testimonial->image)
                        <img src="{{ asset('/admin/assets/images/testimonials/'.$testimonial->image) }}" class="w-full h-full object-cover" alt="{{ $testimonial->name }}">
                    @else
                        <img src="{{ asset('/admin/assets/images/testimonials/no-photo1.jpg') }}" class="w-full h-full object-cover" alt="{{ $testimonial->name }}">
                    @endif
                </div>
                <div class="testi-content">
                        <ul class="stars justify-between max-w-[190px] mb-[10px] flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </ul>
                        <div class="para para-white mb-[10px]">
                            {!! $testimonial->comment !!}
                        </div>
                        <span class="text-white font-secondary font-bold">{!! $testimonial->name !!}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section> --}}
<section class="form-sec py-[50px] md:py-[100px]" style="background: url('{{ asset('/assets/website/images/form-sec-bg.png') }}') no-repeat top/cover;">
    <style>
        .trial-submit-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 48px;
            transition: opacity 0.2s ease;
        }

        .trial-submit-btn.is-loading {
            opacity: 0.85;
            pointer-events: none;
            cursor: wait;
        }

        .trial-submit-btn .loading-spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: trial-btn-spin 0.8s linear infinite;
            flex-shrink: 0;
        }

        .trial-submit-btn.is-loading .loading-spinner {
            display: inline-block;
        }

        .trial-submit-btn.is-loading .submit-btn-text {
            opacity: 0.95;
        }

        @keyframes trial-btn-spin {
            to { transform: rotate(360deg); }
        }
    </style>
    <div class="container">
        <div class="bg-black py-[100px] px-[10px] lg:px-[150px]">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-[20px]">
                <div class="max-w-[500px]"
                    {{-- data-aos="fade-right"
                    data-aos-easing="linear"
                    data-aos-duration="1500" --}}>
                    <h3 class="sec-hd text-center md:text-start mb-[10px]">
                        free 7-day trial
                        signup
                    </h3>
                    <p class="para para-white max-w-[400px] mb-[40px] text-center md:text-start">
                        Sign up for free 7-day trial with us and
                        experience all of our services for free at
                        Fitnex.
                    </p>
                    <div class="border-b border-bottom"></div>
                </div>
                <div {{-- data-aos="fade-left"
                    data-aos-easing="linear"
                    data-aos-duration="1500" --}}>
                    <form action="{{ route('contactus.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="grid grid-cols-2 gap-[20px]">
                            <div class="field-wrap">
                               {{--  <label class="label-field" for="">Name</label> --}}
                                <input class="input-field" type="text" placeholder="Enter your name" name="name" id="name" required>
                            </div>
                            <div class="field-wrap">
                               {{--  <label class="label-field" for="">Phone number</label> --}}
                                <input class="input-field" type="text" placeholder="Enter your phone number" name="phone" id="phone" required>
                            </div>
                            <div class="field-wrap col-span-2">
                                {{-- <label class="label-field" for="">Email</label> --}}
                                <input class="input-field" type="text" placeholder="Enter your email" name="email" id="email" required>
                            </div>
                            <div class="field-wrap col-span-2">
                               {{--  <label class="label-field" for="">Sevices</label> --}}
                                <div class="custom-select-wrapper relative">
                                    <select class="input-field select-field" name="service" id="service" required>         
                                        <option value="" selected>Select Services</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="custom-arrow"><i class="fas fa-chevron-down"></i></span>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <button class="btn primary-btn submit-btn w-full trial-submit-btn" type="submit" id="trial-submit-btn">
                                    <span class="loading-spinner" aria-hidden="true"></span>
                                    <span class="submit-btn-text">Submit</span>
                                </button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function setTrialSubmitLoading(isLoading) {
        var btn = document.getElementById('trial-submit-btn');
        if (!btn) return;
        btn.classList.toggle('is-loading', isLoading);
        btn.disabled = isLoading;
        btn.setAttribute('aria-busy', isLoading ? 'true' : 'false');
    }

    $(document).on('submit', '#regform', function(e) {
        e.preventDefault();
        setTrialSubmitLoading(true);

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message || 'Thank you for contacting us!',
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $('#regform')[0].reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Email not sent',
                        text: response.message || 'Something went wrong! Please try again.',
                    });
                }
            },
            error: function(xhr) {
                var response = xhr.responseJSON || {};
                Swal.fire({
                    icon: 'error',
                    title: response.saved ? 'Saved, but email failed' : 'Submission failed',
                    text: response.message || 'Something went wrong during AJAX request.',
                });
            },
            complete: function() {
                setTrialSubmitLoading(false);
            }
        });
    });
</script>
@endsection
