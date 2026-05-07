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
<section class="expert-trainers-sec relative bg-black py-10 sm:py-14 md:py-16 lg:py-20 xl:py-24 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://framerusercontent.com/images/A1Yi2CbcmDfGLrAKZpFKVI8A4.jpg');"></div>
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-8 sm:mb-10 md:mb-12">
            <h3 class="sec-hd text-2xl sm:text-3xl md:text-4xl mb-2 sm:mb-3"
                {{-- data-aos="flip-right" data-aos-easing="linear" data-aos-duration="500" --}}>Expert Trainers</h3>
            <p class="para para-white max-w-[490px] mx-auto text-sm sm:text-base md:text-lg px-2"
                {{-- data-aos="fade-right" data-aos-easing="linear" data-aos-duration="500" --}}>
                Achieve your fitness goals with our experienced and passionate trainers at strong.
            </p>
        </div>
 
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 justify-items-center max-w-6xl mx-auto">
                @foreach ($trainers as $trainer)
                <div class="trainer-card expert-trainer-item flex flex-col items-center w-full max-w-[280px] sm:max-w-[300px] lg:max-w-[320px]"
                    data-title="{{ $trainer->trainer_type_display }}"
                    data-description="{{ $trainer->description }}"
                    data-price="Price: ${{ $trainer->price }}"
                    data-aos="fade-up" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="{{ $loop->index * 50 }}">
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
            <div class="col-span-1 sm:col-span-2 lg:col-span-4 flex justify-center mt-6 sm:mt-8 w-full" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="500">
                <a href="{{ route('trainers') }}" class="btn primary-btn border border-transparent text-sm sm:text-base py-3 px-5 sm:px-6 md:px-8 min-h-[44px] inline-flex items-center justify-center">View All <span class="ps-2"><i class="fa-solid fa-arrow-right"></i></span></a>
            </div> 
    </div>
</section>
<section class="testimonials-sec bg-black py-[50px] md:py-[100px]">
    <div class="container">
        <h2 class="sec-hd text-center mb-[40px] max-w-[670px] mx-auto"
            {{-- data-aos="flip-right"
            data-aos-easing="linear"
            data-aos-duration="1500" --}}>
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
</section>
<section class="form-sec py-[50px] md:py-[100px]" style="background: url('{{ asset('/assets/website/images/form-sec-bg.png') }}') no-repeat top/cover;">
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
                                <button class="btn primary-btn submit-btn w-full" type="submit">Submit</button>
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
    console.log("Script section loaded!");
    $(document).on('submit', '#regform', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('AJAX Success Response:', response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Thank you for contacting us!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('#regform')[0].reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Response success was false.',
                    });
                }
            },
            error: function(xhr) {
                console.log('AJAX Error XHR:', xhr);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong during AJAX request.',
                });
            }
        });
    }); 
</script>
@endsection
