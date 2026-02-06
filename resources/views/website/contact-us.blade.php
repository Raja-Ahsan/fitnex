@extends('layouts.website.master')
@section('title', $page_title)
@section('content')

<style>
    .primary-theme-text {
        color: #00A3FF !important; /* Your primary theme color */
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

<!-- Contact Us Section -->
<section class="contact-us-page py-10 lg:py-20 bg-black">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10"> 
            <div class="contact-info-wrapper text-white p-6 rounded-lg h-full"> 
                <h2 class="text-3xl font-bold mb-6 text-white">{!! $home_page_data['contact_heading'] !!}</h2>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <i class="fa-solid fa-phone text-2xl primary-theme mr-4"></i>
                        <a href="tel:{{ $home_page_data['contact_phone'] }}" class="text-lg text-white hover:text-gray-300 transition">{{ $home_page_data['contact_phone'] }}</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-solid fa-envelope text-2xl primary-theme mr-4"></i>
                        <a href="mailto:{{ $home_page_data['contact_email'] }}" class="text-lg text-white hover:text-gray-300 transition">{{ $home_page_data['contact_email'] }}</a>
                    </li>
                    <li class="flex items-start">
                        <i class="fa-solid fa-location-dot text-2xl primary-theme mr-4"></i>
                        <span class="text-lg text-white">{{ $home_page_data['contact_address'] }}</span>
                    </li>
                </ul>
                <hr class="my-8 border-gray-700">
                <h3 class="text-2xl font-bold mb-4 text-white">Follow Us</h3>
                <div class="social-icons">
                    <li><a href="{{ $home_page_data['contact_facebok'] }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{ $home_page_data['contact_twiter'] }}"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="{{ $home_page_data['contact_linkdin'] }}"><i class="fab fa-linkedin-in"></i></a></li>
                </div>
            </div>
            <div> 
                <div class="field-wrap p-6 rounded-lg">
                    <h2 class="text-3xl font-bold mb-6 text-white">{!! $home_page_data['form_heading'] !!}</h2>
                    <form action="{{ route('contact.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="mb-5">
                            <label for="name" class="label-field">Full Name</label>
                            <input type="text" class="input-field" id="name" name="name" placeholder="John Doe" required>
                        </div>
                        <div class="mb-5">
                            <label for="email" class="label-field">Email Address</label>
                            <input type="email" class="input-field" id="email" name="email" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-5">
                            <label for="phone" class="label-field">Phone Number</label>
                            <input type="text" class="input-field" id="phone" name="phone" placeholder="Phone Number" required>
                        </div> 
                        <div class="mb-5">
                            <label for="message" class="label-field">Message</label>
                            <textarea class="input-field" id="message" name="message" rows="5" placeholder="How can we help you?" required></textarea>
                        </div>
                        <button type="submit" class="btn primary-btn submit-btn w-full">Send Message</button>
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

