<footer class="footer-sec bg-black pt-[50px] md:pt-[150px] pb-[30px]">
    <div class="container">
        <div class="md:grid flex gap-y-[20px] justify-start flex-col md:grid-cols-5 pb-[50px]" 
        data-aos="fade-down"
                data-aos-easing="linear"
                data-aos-duration="1500"
        >
            <div class="mx-auto col-span-2">
                <div class="footer-logo">
                    <img src="{{ asset('/admin/assets/images/page') }}/{{ $home_page_data['footer_image'] }}" class="footer-logo" alt="footer-logo">
                </div>
                <div class="para para-white">
                    {!! $home_page_data['footer_description'] !!} 
                </div>
            </div>
            <div class="md:mx-auto">
                <h4 class="text-white font-secondary font-bold text-[20px] mb-[20px]">Support</h4>
                <ul class="footer-links">
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Refund Policy</a></li>
                </ul>
            </div>
            <div class="md:mx-auto">
                <h4 class="text-white font-secondary font-bold text-[20px] mb-[20px]">Contact</h4>
                <ul class="footer-links">
                    <li><a href="mailto:{{ $home_page_data['footer_email'] }}"><span class="pe-[10px] primary-theme"><i class="fa-solid fa-envelope"></i></span> {{ $home_page_data['footer_email'] }}</a></li>
                    <li><a href="#"><span class="pe-[10px] primary-theme"><i class="fa-solid fa-location-dot"></i></span>{{ $home_page_data['footer_address'] }}</a></li>
                </ul>
            </div>
            <div class="md:mx-auto">
                <h4 class="text-white font-secondary font-bold text-[20px] mb-[20px]">Social media</h4>
                <ul class="footer-links social-icons"> 
                    <li><a href="{{ $home_page_data['footer_instagram'] }}"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="{{ $home_page_data['footer_linkdin'] }}"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li><a href="{{ $home_page_data['footer_youtube'] }}"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="{{ $home_page_data['footer_twiter'] }}"><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="border-bottom mb-[30px]"></div>
        <p class="para para-white text-center font-secondary font-bold text-[20px]">
            {!! $home_page_data['footer_copy_right_left_side'] !!}
        </p>
    </div>
</footer>