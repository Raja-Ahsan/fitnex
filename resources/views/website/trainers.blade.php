@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
    <style>
        .primary-theme-text {
            color: #0079D4 !important;
        }

        .our-trainers-page {
            --ot-accent: #0079D4;
            --ot-card: #141414;
            --ot-border: rgba(255, 255, 255, 0.1);
            --ot-muted: #a1a1aa;
            background: #0a0a0a;
            font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
        }

        .our-trainers-page .trainer-profile-card {
            max-height: none;
            background: var(--ot-card);
            border: 1px solid var(--ot-border);
            border-radius: 14px;
            overflow: hidden;
            transition: border-color 0.25s ease, transform 0.25s ease;
        }

        .our-trainers-page .trainer-profile-card:hover {
            border-color: rgba(0, 121, 212, 0.45);
            transform: translateY(-3px);
        }

        .our-trainers-page .trainer-profile-card img {
            transition: transform 0.35s ease;
        }

        .our-trainers-page .trainer-profile-card:hover img {
            transform: scale(1.04);
        }

        .our-trainers-page .feature-bar {
            border: 1px solid var(--ot-border);
            border-radius: 14px;
            background: rgba(20, 20, 20, 0.85);
        }

        .our-trainers-page .feature-bar-item + .feature-bar-item {
            border-top: 1px solid var(--ot-border);
        }

        @@media (min-width: 640px) {
            .our-trainers-page .feature-bar-item + .feature-bar-item {
                border-top: 0;
            }
        }

        @@media (min-width: 640px) and (max-width: 1023px) {
            .our-trainers-page .feature-bar-item:nth-child(2n+1) {
                border-left: 0;
            }
            .our-trainers-page .feature-bar-item:nth-child(2n) {
                border-left: 1px solid var(--ot-border);
            }
            .our-trainers-page .feature-bar-item:nth-child(n+3) {
                border-top: 1px solid var(--ot-border);
            }
        }

        @@media (min-width: 1024px) {
            .our-trainers-page .feature-bar-item + .feature-bar-item {
                border-top: 0;
                border-left: 1px solid var(--ot-border);
            }
        }
    </style>

    <section class="inner-banner listing-banner"
        style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/' . $banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
        <div class="container px-4 sm:px-6">
            <h1 class="relative mx-auto text-3xl sm:text-4xl md:text-[50px] text-white font-bold leading-[1.1] text-center">
                @php
                    $title = ($banner && $banner->name) ? $banner->name : 'Our Trainers';
                    $parts = explode(' ', $title, 2);
                @endphp
                <span class="italic uppercase font-black">
                    <span class="primary-theme-text">{{ $parts[0] }}</span>@if(isset($parts[1])) {{ $parts[1] }}@endif
                </span>
            </h1>
        </div>
    </section>

    <section class="our-trainers-page relative py-12 sm:py-16 md:py-20 lg:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 max-w-7xl">
            <div class="text-center mb-10 sm:mb-12 md:mb-14">
                <p class="text-[11px] sm:text-xs tracking-[0.22em] uppercase font-semibold text-[var(--ot-accent)] mb-3">
                    Expert Trainers
                </p>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4 font-secondary">
                    Our Trainers
                </h2>
                <div class="w-12 h-[2px] bg-[var(--ot-accent)] mx-auto mb-5"></div>

                @if(isset($selectedCategory) && $selectedCategory)
                    <p class="text-[var(--ot-muted)] max-w-xl mx-auto text-sm sm:text-base leading-relaxed px-2">
                        Showing:
                        <span class="text-white font-semibold">{{ $selectedCategory->title }}</span>
                        @if(!empty($selectedDelivery))
                            — {{ ($selectedDelivery === 'online') ? 'Online' : 'In-person' }} sessions
                        @endif
                    </p>
                @elseif(!empty($noTrainersAvailable))
                    <p class="text-[var(--ot-muted)] max-w-xl mx-auto text-sm sm:text-base leading-relaxed px-2 mb-2">
                        No trainers available for this service.
                    </p>
                    <a href="{{ route('trainers') }}" class="inline-block mt-1 text-sm text-[var(--ot-accent)] hover:text-white underline underline-offset-4">View all professionals</a>
                @else
                    <p class="text-[var(--ot-muted)] max-w-xl mx-auto text-sm sm:text-base leading-relaxed px-2">
                        Our certified trainers and coaches are here to help you move better, feel stronger, and achieve your goals.
                    </p>
                @endif
            </div>

            @if(!empty($noTrainersAvailable))
                <div class="text-center py-12 sm:py-16">
                    <p class="text-[var(--ot-muted)] text-base sm:text-lg max-w-xl mx-auto mb-6">
                        No trainers are currently available for this service. Use the link above to view all our professionals.
                    </p>
                    <a href="{{ route('trainers') }}"
                        class="btn primary-btn border border-transparent text-sm sm:text-base py-3 px-5 sm:px-6 md:px-8 min-h-[44px] inline-flex items-center justify-center">
                        View all professionals
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 lg:gap-7 mb-10 sm:mb-12 md:mb-14">
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
                                $tagIcon = 'fa-bullseye';
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

                <div class="feature-bar grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 overflow-hidden">
                    <div class="feature-bar-item flex items-start gap-4 p-5 sm:p-6">
                        <div class="shrink-0 w-12 h-12 text-[var(--ot-accent)]" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="w-full h-full">
                                <circle cx="12" cy="9" r="5.25" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.5 13.5 7 21l5-2.5L17 21l-1.5-7.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 8.5h3M12 7v4" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-white text-xs sm:text-[13px] font-bold tracking-[0.08em] uppercase mb-1.5">Certified Professionals</h4>
                            <p class="text-[var(--ot-muted)] text-xs sm:text-sm leading-relaxed">All trainers are certified and continuously expanding their knowledge.</p>
                        </div>
                    </div>
                    <div class="feature-bar-item flex items-start gap-4 p-5 sm:p-6">
                        <div class="shrink-0 w-[60px] h-[60px] flex items-center justify-center" aria-hidden="true">
                            <img src="{{ asset('assets/website/images/icons/bullseye.png') }}"
                                alt="" class="w-[60px] h-[60px] object-contain" width="60" height="60">
                        </div>
                        <div>
                            <h4 class="text-white text-xs sm:text-[13px] font-bold tracking-[0.08em] uppercase mb-1.5">Personalized Approach</h4>
                            <p class="text-[var(--ot-muted)] text-xs sm:text-sm leading-relaxed">We tailor every program to your unique goals and lifestyle.</p>
                        </div>
                    </div>
                    <div class="feature-bar-item flex items-start gap-4 p-5 sm:p-6">
                        <div class="shrink-0 w-[60px] h-[60px] flex items-center justify-center" aria-hidden="true">
                            <img src="{{ asset('assets/website/images/icons/bar-chart.png') }}"
                                alt="" class="w-[60px] h-[60px] object-contain" width="60" height="60">
                        </div>
                        <div>
                            <h4 class="text-white text-xs sm:text-[13px] font-bold tracking-[0.08em] uppercase mb-1.5">Proven Results</h4>
                            <p class="text-[var(--ot-muted)] text-xs sm:text-sm leading-relaxed">Our methods are designed to deliver real, lasting transformations.</p>
                        </div>
                    </div>
                    <div class="feature-bar-item flex items-start gap-4 p-5 sm:p-6">
                        <div class="shrink-0 w-12 h-12 text-[var(--ot-accent)]" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="w-full h-full">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-white text-xs sm:text-[13px] font-bold tracking-[0.08em] uppercase mb-1.5">Support Every Step</h4>
                            <p class="text-[var(--ot-muted)] text-xs sm:text-sm leading-relaxed">We're with you every step of the way on your fitness journey.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
