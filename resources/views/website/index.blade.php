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
                        <div class="label-area c" data-aos="fade-down"
                            data-aos-easing="linear"
                            data-aos-duration="1500">
                            {{ $homeslider->title }}
                        </div> 
                    @endif  
                    <div>
                        @if($homeslider->heading) 
                            <h1 class="relative text-[50px] md:text-[70px] lg:text-[80px] xxl:text-[100px] text-white font-bold leading-[1.1] lg:max-w-[680px] xxl:max-w-[860px]"
                                data-aos="flip-right"
                                data-aos-easing="linear"
                                data-aos-duration="1500"> 
                                {!! formatFitnexText($homeslider->heading) !!}
                            </h1>
                        @endif 
                        @if($homeslider->description) 
                            <div class="text-white font-secondary  text-[20px] mx-auto mb-[20px] max-w-[600px]" data-aos="fade-right"
                                data-aos-easing="linear"
                                data-aos-duration="1500">
                                {!! $homeslider->description !!}
                            </div>
                        @endif 
                        <div class="flex justify-center" data-aos="fade-up"
                            data-aos-easing="linear"
                            data-aos-duration="1500">
                            <a href="" class="btn primary-btn border border-transparent">Join as a Coach <span class="ps-[10px]"><i class="fa-solid fa-arrow-right"></i></span></a>
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
            data-aos="flip-right"
            data-aos-easing="linear"
            data-aos-duration="1500">our services</h2>
        <p class="para text-center max-w-[490px] mx-auto para-white mb-[30px]"
            data-aos="fade-right"
            data-aos-easing="linear"
            data-aos-duration="1500">
            Strong offers 5 popular services to help you make
            comfortable choices that suit your needs.
        </p>
    </div>
    <div class="grid grid-cols-1 justify-items-center md:grid-cols-3 lg:grid-cols-5 gap-y-[20px]">
        @foreach ($categories as $category)
        <div>
            <div class="our-services-item relative" style="height: 100%"
                data-aos="fade-up"
                data-aos-duration="600"
                data-aos-delay="{{ $loop->index * 100 }}"
                >
                <img src="{{ asset('/admin/assets/images/services/'.$category->image) }}" class="relative z-[1] h-full w-auto mx-auto" alt="">
                <div class="our-services-content">
                    <h4 class="">
                        {{ $category->title }}
                    </h4>
                </div>
            </div>
        </div>
        @endforeach 
    </div>
</section>
<section class="fitness-journey bg-black py-[50px] md:py-[100px]">
    <div class="container">
        <h2 class="sec-hd text-center mb-[10px] max-w-[670px] mx-auto"
            data-aos="flip-right"
            data-aos-easing="linear"
            data-aos-duration="1500">
            let's Transform Your
            Fitness Journey
        </h2>
        <p class="para text-center max-w-[490px] mx-auto para-white mb-[80px]"
            data-aos="fade-right"
            data-aos-easing="linear"
            data-aos-duration="1500">
            10 years of experience in the fitness industry and trusted by over 100.000 customers.
        </p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 justify-between items-center max-w-[1000px] mx-auto mb-[40px]"
        data-aos="fade-down"
        data-aos-easing="linear"
        data-aos-duration="1500">
        <div class="text-center">
            <h4 class="text-[48px] font-bold primary-theme count" data-number="100000">
                +100k
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
            <div class="text-center md:text-start" data-aos="fade-right"
                data-aos-easing="linear"
                data-aos-duration="1500">
                <h3 class="sec-hd mb-[20px]">{{ $home_page_data['home_about_title'] }}</h3>
                <div class="para para-white mb-[10px]">
                    {!! $home_page_data['home_about_description'] !!}
                </div>
                <div class="flex justify-center md:justify-start">
                    <a href="{{ route('about-us') }}" class="btn primary-btn">Leann More</a>
                </div>
            </div>
            <div
                data-aos="fade-left"
                data-aos-easing="linear"
                data-aos-duration="1500">
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
    <!-- <img id="cursor-card-img" src="" alt="" class="w-full h-40 object-cover rounded-t-lg"> -->
    <div class="p-4">
        <h3 id="cursor-card-title" class="text-xl font-bold text-white mb-[10px]"></h3>
        <p id="cursor-card-description" class="text-sm text-white"></p>
        <span id="cursor-card-price" class="text-sm text-white font-bold"></span>
    </div>
</div>
<section class="expert-trainers-sec relative bg-black py-[50px] md:py-[100px]">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://framerusercontent.com/images/A1Yi2CbcmDfGLrAKZpFKVI8A4.jpg');"></div>
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
                            <img src="{{ asset('/admin/assets/images/UserImage/'.$trainer->image ) }}" class="w-full h-full object-cover object-top" alt="{{ $trainer->name }}">
                        @else
                            <img src="{{ asset('/admin/assets/images/trainers/no-photo1.jpg') }}" class="w-full h-full object-cover object-top" alt="{{ $trainer->name }}">
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
                <div class="col-span-1 md:col-span-4" data-aos="fade-up"
                    data-aos-easing="linear"
                    data-aos-duration="1500">
                    <a href="{{route('trainers')}}" class="btn primary-btn border border-transparent">View All <span class="ps-[10px]"><i class="fa-solid fa-arrow-right"></i></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonials-sec bg-black py-[50px] md:py-[100px]">
    <div class="container">
        <h2 class="sec-hd text-center mb-[40px] max-w-[670px] mx-auto"
            data-aos="flip-right"
            data-aos-easing="linear"
            data-aos-duration="1500">
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
                    data-aos="fade-right"
                    data-aos-easing="linear"
                    data-aos-duration="1500">
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
                <div data-aos="fade-left"
                    data-aos-easing="linear"
                    data-aos-duration="1500">
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
