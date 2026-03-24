@php
    $wellnessSpecs = config('wellness_nav.specialties', []);
    $trainersNavActive = request()->routeIs('trainers');
@endphp
<header class="header bg-black py-[10px]">
    <div class="container" data-aos="fade-down"
         data-aos-easing="linear"
         data-aos-duration="1500">
        @if($home_page_data['footer_email'] ?? '')
        <div class="topbar text-end mb-[5px]">
            <a href="mailto:{{ $home_page_data['footer_email'] }}" class="text-white font-secondary "><span class="pe-[10px] text-[#0079D4]"><i class="fa-solid fa-envelope"></i></span>{{ $home_page_data['footer_email'] }}</a>
        </div>
        <div class="border-b border-bottom mb-[10px]"></div>
        @endif
        <div class="flex items-center justify-between">
            <div class="logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('/admin/assets/images/page') }}/{{ $home_page_data['header_logo'] ?? '' }}" alt="logo">
                </a>
            </div>
            <!-- header -->
            <nav class="hidden lg:block">
                <ul class="flex primary-navs font-secondary text-white items-center flex-wrap gap-y-2">
                    <li><a href="{{ route('index') }}" class="px-[20px] {{ request()->routeIs('index') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about-us') }}" class="px-[20px] {{ request()->routeIs('about-us') ? 'active' : '' }}">About us</a></li>

                    <li class="relative group site-nav-dd">
                        <button type="button" class="site-nav-dd__trigger px-[20px] {{ $trainersNavActive ? 'active' : '' }}" aria-expanded="false" aria-haspopup="true">
                            Find a wellness professional <i class="fa-solid fa-chevron-down text-[10px] ms-1 opacity-80"></i>
                        </button>
                        <div class="site-nav-dd__panel">
                            <ul class="site-nav-dd__list">
                                @foreach($wellnessSpecs as $spec)
                                <li class="relative site-nav-dd__has-sub">
                                    <span class="site-nav-dd__row">
                                        <span>{{ $spec['label'] }}</span>
                                        <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>
                                    </span>
                                    <div class="site-nav-dd__sub-wrap">
                                        <ul class="site-nav-dd__sub">
                                            <li><a href="{{ route('trainers', ['category' => $spec['slug'], 'delivery' => 'in_person']) }}">In-person</a></li>
                                            <li><a href="{{ route('trainers', ['category' => $spec['slug'], 'delivery' => 'online']) }}">Online</a></li>
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                                <li class="site-nav-dd__footer">
                                    <a href="{{ route('trainers') }}">View all professionals</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="relative group site-nav-dd">
                        <button type="button" class="site-nav-dd__trigger px-[20px] {{ request()->routeIs('registration') ? 'active' : '' }}" aria-expanded="false" aria-haspopup="true">
                            Join as a coach <i class="fa-solid fa-chevron-down text-[10px] ms-1 opacity-80"></i>
                        </button>
                        <div class="site-nav-dd__panel site-nav-dd__panel--join">
                            <ul class="site-nav-dd__list">
                                @foreach($wellnessSpecs as $spec)
                                <li class="relative site-nav-dd__has-sub">
                                    <span class="site-nav-dd__row">
                                        <span>{{ $spec['label'] }}</span>
                                        <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>
                                    </span>
                                    <div class="site-nav-dd__sub-wrap">
                                        <ul class="site-nav-dd__sub">
                                            <li><a href="{{ route('registration', ['category' => $spec['slug'], 'delivery' => 'in_person']) }}">In-person coaching</a></li>
                                            <li><a href="{{ route('registration', ['category' => $spec['slug'], 'delivery' => 'online']) }}">Online coaching</a></li>
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                                <li class="site-nav-dd__footer">
                                    <a href="{{ route('registration') }}">Coach registration</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li><a href="{{ route('blogs') }}" class="px-[20px] {{ request()->routeIs('blogs') ? 'active' : '' }}">Blog</a></li>
                    <li><a href="{{ route('contact-us') }}" class="px-[20px] {{ request()->routeIs('contact-us') ? 'active' : '' }}">Contact us</a></li>
                    @if(!Auth::check())
                        <li><a href="{{ route('login') }}" class="px-[20px] {{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>

                    @else
                        @if(Auth::user()->hasRole('trainer'))
                            <li><a href="{{ route('trainer.dashboard') }}" class="px-[20px] {{ request()->routeIs('trainer.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                        @elseif(Auth::user()->hasRole('admin'))
                            <li><a href="{{ route('dashboard') }}" class="px-[20px] {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('registration') }}" class="px-[20px] {{ request()->routeIs('registration') ? 'active' : '' }}">Sign Up</a></li>
                        @endif
                    @endif

                </ul>
            </nav>
            <div>
                <div class="text-end hidden lg:block">
                    <a href="{{ route('registration') }}" class="btn primary-btn border border-transparent">Try for FREE</a>
                </div>
                <div class="menu-icon flex justify-end lg:hidden">
                    <i class="fa-solid fa-bars menu-toggle text-white text-[24px] cursor-pointer"></i>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" class="fixed top-0 left-[-100%] w-full h-full bg-black bg-opacity-95 z-[999] transition-all duration-300 overflow-y-auto">
    <div class="close-icon text-right p-[20px]">
        <i class="fa-solid fa-xmark menu-toggle text-white text-[24px] cursor-pointer"></i>
    </div>
    <nav class="mt-[20px] pb-10">
        <ul class="primary-navs font-secondary text-left px-4 max-w-lg mx-auto">
            <li class="py-[12px] text-center"><a href="{{ route('index') }}" class="text-white {{ request()->routeIs('index') ? 'active' : '' }}">Home</a></li>
            <li class="py-[12px] text-center"><a href="{{ route('about-us') }}" class="text-white {{ request()->routeIs('about-us') ? 'active' : '' }}">About us</a></li>

            <li class="py-[8px] mt-2 border-t border-white/10">
                <p class="text-[#0079D4] text-xs font-semibold uppercase tracking-wide mb-2">Find a wellness professional</p>
                @foreach($wellnessSpecs as $spec)
                <details class="mobile-wellness-details border-b border-white/10 py-2">
                    <summary class="text-white cursor-pointer flex justify-between items-center text-sm list-none">{{ $spec['label'] }} <i class="fa-solid fa-chevron-down text-xs opacity-70"></i></summary>
                    <div class="flex flex-col gap-2 mt-2 pl-1">
                        <a href="{{ route('trainers', ['category' => $spec['slug'], 'delivery' => 'in_person']) }}" class="text-white/90 text-sm py-1">In-person</a>
                        <a href="{{ route('trainers', ['category' => $spec['slug'], 'delivery' => 'online']) }}" class="text-white/90 text-sm py-1">Online</a>
                    </div>
                </details>
                @endforeach
                <a href="{{ route('trainers') }}" class="inline-block mt-3 mb-2 text-sm text-[#0079D4]">View all professionals</a>
            </li>

            <li class="py-[8px] mt-2 border-t border-white/10">
                <p class="text-[#0079D4] text-xs font-semibold uppercase tracking-wide mb-2">Join as a coach</p>
                @foreach($wellnessSpecs as $spec)
                <details class="mobile-wellness-details border-b border-white/10 py-2">
                    <summary class="text-white cursor-pointer flex justify-between items-center text-sm list-none">{{ $spec['label'] }} <i class="fa-solid fa-chevron-down text-xs opacity-70"></i></summary>
                    <div class="flex flex-col gap-2 mt-2 pl-1">
                        <a href="{{ route('registration', ['category' => $spec['slug'], 'delivery' => 'in_person']) }}" class="text-white/90 text-sm py-1">In-person coaching</a>
                        <a href="{{ route('registration', ['category' => $spec['slug'], 'delivery' => 'online']) }}" class="text-white/90 text-sm py-1">Online coaching</a>
                    </div>
                </details>
                @endforeach
                <a href="{{ route('registration') }}" class="inline-block mt-3 mb-2 text-sm text-[#0079D4]">Coach registration</a>
            </li>

            <li class="py-[12px] text-center"><a href="{{ route('blogs') }}" class="text-white {{ request()->routeIs('blogs') ? 'active' : '' }}">Blog</a></li>
            <li class="py-[12px] text-center"><a href="{{ route('contact-us') }}" class="text-white {{ request()->routeIs('contact-us') ? 'active' : '' }}">Contact us</a></li>
            <li class="py-[15px] text-center">
                <a href="{{ route('registration') }}" class="btn primary-btn border border-transparent">Try for FREE</a>
            </li>
        </ul>
    </nav>
</div>
