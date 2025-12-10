<header class="header bg-black py-[10px]">
    <div class="container" data-aos="fade-down"
         data-aos-easing="linear"
         data-aos-duration="1500">
        <div class="topbar text-end mb-[5px]">
            <a href="#" class="text-white font-secondary "><span class="pe-[10px] text-[#0079D4]"><i class="fa-solid fa-envelope"></i></span>youremailhere@.com</a>
        </div>
        <div class="border-b border-bottom mb-[10px]"></div>
        <div class="flex items-center justify-between">
            <div class="logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('/admin/assets/images/page') }}/{{ $home_page_data['header_logo'] ?? '' }}" alt="logo">
                </a>
            </div>
            <nav class="hidden lg:block">
                <ul class="flex primary-navs font-secondary text-white items-center">
                    <li><a href="{{ route('index') }}" class="px-[20px] {{ request()->routeIs('index') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about-us') }}" class="px-[20px] {{ request()->routeIs('about-us') ? 'active' : '' }}">About us</a></li>
                    <li><a href="{{ route('trainers') }}" class="px-[20px] {{ request()->routeIs('trainers') ? 'active' : '' }}">Trainers</a></li>
                    <li><a href="{{ route('blogs') }}" class="px-[20px] {{ request()->routeIs('blogs') ? 'active' : '' }}">Blog</a></li>
                    <li><a href="{{ route('contact-us') }}" class="px-[20px] {{ request()->routeIs('contact-us') ? 'active' : '' }}">Contact us</a></li>
                </ul>
            </nav>
            <div>
                <div class="text-end hidden lg:block">
                    <a href="#" class="btn primary-btn border border-transparent">Try for FREE</a>
                </div>
                <div class="menu-icon flex justify-end lg:hidden">
                    <i class="fa-solid fa-bars menu-toggle text-white text-[24px] cursor-pointer"></i>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" class="fixed top-0 left-[-100%] w-full h-full bg-black bg-opacity-95 z-[999] transition-all duration-300">
    <div class="close-icon text-right p-[20px]">
        <i class="fa-solid fa-xmark menu-toggle text-white text-[24px] cursor-pointer"></i>
    </div>
    <nav class="mt-[50px]">
        <ul class="primary-navs font-secondary text-center">
            <li class="py-[15px]"><a href="{{ route('index') }}" class="text-white {{ request()->routeIs('index') ? 'active' : '' }}">Home</a></li>
            <li class="py-[15px]"><a href="{{ route('about-us') }}" class="text-white {{ request()->routeIs('about-us') ? 'active' : '' }}">About us</a></li>
            <li class="py-[15px]"><a href="{{ route('trainers') }}" class="text-white {{ request()->routeIs('trainers') ? 'active' : '' }}">Trainers</a></li>
            <li class="py-[15px]"><a href="{{ route('blogs') }}" class="text-white {{ request()->routeIs('blogs') ? 'active' : '' }}">Blog</a></li>
            <li class="py-[15px]"><a href="{{ route('contact-us') }}" class="text-white {{ request()->routeIs('contact-us') ? 'active' : '' }}">Contact us</a></li>
            <li class="py-[15px]">
                <a href="#" class="btn primary-btn border border-transparent">Try for FREE</a>
            </li>
        </ul>
    </nav>
</div>