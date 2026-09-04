@extends('layouts.website.master')
@php
    $serviceIcons = [
        'personal-training' => 'fa-dumbbell',
        'nutrition-coaching' => 'fa-leaf',
        'sports-performance' => 'fa-person-running',
        'body-building' => 'fa-medal',
        'custom-goal-based-plans' => 'fa-bullseye',
        'weight-loss-coach' => 'fa-weight-scale',
        'strength-and-conditioning-coach' => 'fa-dumbbell',
    ];
    $serviceLabels = [
        'personal-training' => 'Personal Training',
        'nutrition-coaching' => 'Nutrition',
        'sports-performance' => 'Sports Performance',
        'body-building' => 'Bodybuilding',
        'custom-goal-based-plans' => 'Custom Plans',
        'weight-loss-coach' => 'Weight Loss',
        'strength-and-conditioning-coach' => 'Strength & Conditioning',
    ];
@endphp
@section('title', $page_title)
@section('content')
    <style>
        [x-cloak] { display: none !important; }

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

        .finder-choice {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            width: 100%;
            text-align: left;
            background: var(--ot-card);
            border: 1px solid var(--ot-border);
            border-radius: 14px;
            padding: 16px 18px;
            color: #fff;
            cursor: pointer;
            min-height: 64px;
            transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        }

        .finder-choice:hover,
        .finder-choice:focus-visible {
            border-color: rgba(0, 121, 212, 0.7);
            outline: none;
        }

        .finder-choice.is-selected {
            border-color: var(--ot-accent);
            background: rgba(0, 121, 212, 0.12);
            box-shadow: inset 0 0 0 1px rgba(0, 121, 212, 0.35);
        }

        .finder-choice__mark {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            margin-top: 2px;
            border-radius: 6px;
            border: 1.5px solid rgba(255, 255, 255, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: transparent;
        }

        .finder-choice.is-selected .finder-choice__mark {
            background: var(--ot-accent);
            border-color: var(--ot-accent);
            color: #fff;
        }

        .finder-choice--radio .finder-choice__mark {
            border-radius: 999px;
        }

        .listing-banner.finder-banner {
            padding-block: 36px !important;
        }

        .listing-banner.finder-banner h1,
        .listing-banner.finder-banner .primary-theme-text,
        .listing-banner.finder-banner .italic {
            font-size: 1.85rem !important;
            line-height: 1.2 !important;
        }

        .finder-choice--compact {
            min-height: 56px;
            padding: 14px 16px;
            align-items: center;
        }

        .finder-choice--compact .finder-choice__mark {
            margin-top: 0;
        }

        .finder-delivery {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .finder-delivery .finder-choice {
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-height: 132px;
            padding: 20px 14px;
            gap: 8px;
        }

        .finder-delivery .finder-choice__icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(0, 121, 212, 0.12);
            color: var(--ot-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .finder-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .finder-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 18px;
            min-height: 44px;
            border-radius: 999px;
            border: 1px solid var(--ot-border);
            background: var(--ot-card);
            color: #fff;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: border-color 0.2s ease, background 0.2s ease;
        }

        .finder-pill:hover,
        .finder-pill:focus-visible {
            border-color: rgba(0, 121, 212, 0.7);
            outline: none;
        }

        .finder-pill.is-selected {
            border-color: var(--ot-accent);
            background: rgba(0, 121, 212, 0.15);
        }

        .finder-chip {
            display: inline-flex;
            align-items: center;
            padding: 5px 11px;
            border-radius: 999px;
            background: rgba(0, 121, 212, 0.28);
            color: #fff;
            font-size: 12px;
            font-weight: 500;
        }

        .finder-actions {
            position: sticky;
            bottom: 0;
            z-index: 5;
            margin-top: 1.5rem;
            padding: 1rem 0 0.25rem;
            background: linear-gradient(to bottom, rgba(10, 10, 10, 0), #0a0a0a 28%);
        }

        .finder-field {
            background: #1A1A1A;
            border: 1px solid var(--ot-border);
            border-radius: 10px;
            padding: 14px 16px;
            width: 100%;
            color: #fff;
            font-family: inherit;
            min-height: 48px;
        }

        .finder-field:focus {
            outline: 2px solid rgba(0, 121, 212, 0.55);
            outline-offset: 1px;
            border-color: var(--ot-accent);
        }

        .finder-field::placeholder {
            color: #71717a;
        }

        .finder-error {
            color: #f87171;
            font-size: 0.875rem;
            margin-top: 10px;
        }

        #finder-results {
            scroll-margin-top: 24px;
        }

        @@media (min-width: 640px) {
            .listing-banner.finder-banner {
                padding-block: 44px !important;
            }

            .listing-banner.finder-banner h1,
            .listing-banner.finder-banner .primary-theme-text,
            .listing-banner.finder-banner .italic {
                font-size: 2.25rem !important;
            }

            .finder-delivery {
                grid-template-columns: repeat(3, 1fr);
            }
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

    <div x-data="wellnessFinder()">
    <section class="inner-banner listing-banner finder-banner"
        x-show="phase !== 'results'"
        style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/' . $banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
        <div class="container px-4 sm:px-6">
            <h1 class="relative mx-auto text-3xl sm:text-4xl md:text-[50px] text-white font-bold leading-[1.1] text-center">
                <span class="italic uppercase font-black">
                    <span class="primary-theme-text">Find</span> a Wellness Professional
                </span>
            </h1>
        </div>
    </section>

    <section class="our-trainers-page relative py-10 sm:py-14 md:py-16" x-cloak>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 max-w-7xl">
            <div class="text-center mb-6 sm:mb-8" x-show="phase === 'results'">
                <p class="text-[11px] sm:text-xs tracking-[0.22em] uppercase font-semibold text-[var(--ot-accent)] mb-3">
                    Match with a coach
                </p>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4 font-secondary">Your Wellness Professional Matches</h2>
                <div class="w-12 h-[2px] bg-[var(--ot-accent)] mx-auto mb-4"></div>
                <p class="text-[var(--ot-muted)] max-w-xl mx-auto text-sm sm:text-base leading-relaxed px-2"
                    x-show="count > 0"
                    x-text="matchSummary"></p>
            </div>

            <div class="max-w-xl mx-auto mb-8" x-show="phase === 'wizard'">
                <p class="text-center text-sm text-[var(--ot-muted)] mb-3">
                    Question <span class="text-white font-semibold" x-text="step"></span> of 3
                </p>
                <div class="h-1.5 rounded-full bg-white/10 overflow-hidden" aria-hidden="true">
                    <div class="h-full bg-[var(--ot-accent)] rounded-full transition-all duration-300"
                        :style="'width:' + ((step / 3) * 100) + '%'"></div>
                </div>
            </div>

            <div class="flex flex-wrap justify-center gap-2 mb-6" x-show="phase === 'wizard' && (services.length || delivery)">
                <template x-for="label in selectedServiceLabels" :key="label">
                    <span class="finder-chip" x-text="label"></span>
                </template>
                <span class="finder-chip" x-show="delivery" x-text="deliverySummary"></span>
                <span class="finder-chip" x-show="city || state" x-text="[city, state].filter(Boolean).join(', ')"></span>
            </div>

            <div class="max-w-3xl mx-auto mb-10 sm:mb-14" x-show="phase === 'wizard'" :inert="phase !== 'wizard'">
                {{-- Step 1: Services --}}
                <div x-show="step === 1" :inert="step !== 1">
                    <h3 class="text-white text-xl sm:text-2xl font-bold mb-2">What do you need help with?</h3>
                    <p class="text-[var(--ot-muted)] text-sm mb-5">Tap one or more.</p>
                    <div class="finder-pills" role="group" aria-label="Services">
                        @foreach($categories as $category)
                            <button type="button"
                                class="finder-pill"
                                :class="isSelected('services', '{{ $category->slug }}') ? 'is-selected' : ''"
                                role="checkbox"
                                :aria-checked="isSelected('services', '{{ $category->slug }}')"
                                x-on:click="toggleValue('services', '{{ $category->slug }}')">
                                <i class="fa-solid {{ $serviceIcons[$category->slug] ?? 'fa-heart-pulse' }} text-[var(--ot-accent)] me-2" aria-hidden="true"></i>
                                {{ $serviceLabels[$category->slug] ?? $category->title }}
                            </button>
                        @endforeach
                    </div>
                    <p class="finder-error" x-show="error" x-text="error"></p>
                </div>

                {{-- Step 2: How + location --}}
                <div x-show="step === 2" :inert="step !== 2">
                    <h3 class="text-white text-xl sm:text-2xl font-bold mb-2">Online or in person?</h3>
                    <p class="text-[var(--ot-muted)] text-sm mb-5">We’ll only ask for your city if you want to meet locally.</p>
                    <div class="finder-delivery mb-5" role="radiogroup" aria-label="Training type">
                        <template x-for="option in deliveryOptions" :key="option.value">
                            <button type="button"
                                class="finder-choice finder-choice--radio"
                                :class="delivery === option.value ? 'is-selected' : ''"
                                role="radio"
                                :aria-checked="delivery === option.value"
                                x-on:click="chooseDelivery(option.value)">
                                <span class="finder-choice__icon" aria-hidden="true">
                                    <i class="fa-solid" :class="option.icon"></i>
                                </span>
                                <span>
                                    <span class="block font-semibold" x-text="option.label"></span>
                                    <span class="block text-sm text-[var(--ot-muted)] mt-1" x-text="option.hint"></span>
                                </span>
                            </button>
                        </template>
                    </div>
                    <div x-show="delivery === 'in_person' || delivery === 'both'" x-cloak>
                        <p class="text-white text-sm font-medium mb-3" x-show="delivery === 'in_person'">Where should we look?</p>
                        <p class="text-[var(--ot-muted)] text-sm mb-3" x-show="delivery === 'both'">City and state are optional — add them to see nearby coaches too.</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="finder-city" class="block text-white text-sm mb-2">City <span class="text-[var(--ot-muted)]" x-show="delivery !== 'in_person'">(optional)</span></label>
                                <input id="finder-city" type="text" class="finder-field" autocomplete="address-level2" placeholder="e.g. Dallas" x-model="city">
                            </div>
                            <div>
                                <label for="finder-state" class="block text-white text-sm mb-2">State <span class="text-[var(--ot-muted)]" x-show="delivery !== 'in_person'">(optional)</span></label>
                                <input id="finder-state" type="text" class="finder-field" autocomplete="address-level1" placeholder="e.g. TX" x-model="state">
                            </div>
                        </div>
                    </div>
                    <p class="finder-error" x-show="error" x-text="error"></p>
                </div>

                {{-- Step 3: Goals --}}
                <div x-show="step === 3" :inert="step !== 3">
                    <h3 class="text-white text-xl sm:text-2xl font-bold mb-2">Any specific goal?</h3>
                    <p class="text-[var(--ot-muted)] text-sm mb-5">Optional. Skip this if you’re not sure — we’ll still find matches.</p>
                    <div class="finder-pills" role="group" aria-label="Goals">
                        @foreach($goals as $goalKey => $goal)
                            @continue($goalKey === 'other')
                            <button type="button"
                                class="finder-pill"
                                :class="isSelected('goals', '{{ $goalKey }}') ? 'is-selected' : ''"
                                role="checkbox"
                                :aria-checked="isSelected('goals', '{{ $goalKey }}')"
                                x-on:click="toggleValue('goals', '{{ $goalKey }}')">
                                {{ $goal['label'] }}
                            </button>
                        @endforeach
                    </div>
                    <p class="finder-error" x-show="error" x-text="error"></p>
                </div>

                <div class="finder-actions flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3">
                    <button type="button"
                        class="btn border border-white/20 text-white min-h-[44px] inline-flex items-center justify-center"
                        x-show="step > 1"
                        x-on:click="back()">
                        <i class="fa-solid fa-arrow-left me-2" aria-hidden="true"></i> Back
                    </button>
                    <span x-show="step === 1"></span>
                    <button type="button"
                        class="btn primary-btn border border-transparent min-h-[44px] inline-flex items-center justify-center"
                        x-show="step < 3"
                        x-on:click="continueStep()">
                        Continue <i class="fa-solid fa-arrow-right ms-2" aria-hidden="true"></i>
                    </button>
                    <button type="button"
                        class="btn primary-btn border border-transparent min-h-[44px] inline-flex items-center justify-center"
                        x-show="step === 3"
                        :disabled="loading"
                        x-on:click="findMatches()">
                        <span x-show="!loading">Find My Matches</span>
                        <span x-show="loading"><i class="fa-solid fa-spinner fa-spin me-2" aria-hidden="true"></i> Finding matches…</span>
                    </button>
                </div>
            </div>

            <div id="finder-results" x-ref="results" x-show="phase === 'results'" :inert="phase !== 'results'">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-8">
                    <button type="button"
                        class="btn border border-white/20 text-white min-h-[44px] inline-flex items-center justify-center"
                        x-on:click="editFilters()">
                        <i class="fa-solid fa-sliders me-2" aria-hidden="true"></i>
                        <span x-text="count > 0 ? 'Change Preferences' : 'Adjust Filters'"></span>
                    </button>
                </div>

                <div x-show="count === 0" class="text-center py-12 sm:py-16">
                    <p class="text-white text-lg sm:text-xl font-semibold mb-3">We couldn’t find an exact match.</p>
                    <p class="text-[var(--ot-muted)] text-base max-w-xl mx-auto mb-6">
                        Try adjusting your preferences to see more wellness professionals.
                    </p>
                    <button type="button"
                        class="btn primary-btn border border-transparent text-sm sm:text-base py-3 px-5 sm:px-6 min-h-[44px] inline-flex items-center justify-center"
                        x-on:click="editFilters()">
                        Adjust Filters
                    </button>
                </div>

                <div x-show="count > 0">
                    <div x-html="resultsHtml"></div>
                    <div class="flex justify-center items-center gap-3 mt-8" x-show="lastPage > 1">
                        <button type="button" class="btn border border-white/20 text-white min-h-[44px]" :disabled="page <= 1 || loading" x-on:click="goPage(page - 1)">Previous</button>
                        <span class="text-[var(--ot-muted)] text-sm" x-text="'Page ' + page + ' of ' + lastPage"></span>
                        <button type="button" class="btn border border-white/20 text-white min-h-[44px]" :disabled="page >= lastPage || loading" x-on:click="goPage(page + 1)">Next</button>
                    </div>
                </div>
            </div>

            <div class="feature-bar grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 overflow-hidden mt-10 sm:mt-12 md:mt-14">
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
        </div>
    </section>
    </div>
@endsection

@section('script')
<script>
    function wellnessFinder() {
        const servicesCatalog = @json($categories->map(fn ($c) => [
            'slug' => $c->slug,
            'title' => $serviceLabels[$c->slug] ?? $c->title,
        ])->values());
        const prefill = @json($prefill);
        const searchUrl = @json($searchUrl);

        const initialServices = Array.isArray(prefill.services) ? prefill.services : [];
        const initialDelivery = prefill.delivery || '';
        let initialStep = 1;
        if (initialServices.length && initialDelivery === 'online') {
            initialStep = 3;
        } else if (initialServices.length) {
            initialStep = 2;
        }

        return {
            step: initialStep,
            phase: 'wizard',
            services: initialServices,
            delivery: initialDelivery,
            city: '',
            state: '',
            zip: '',
            radius: 25,
            goals: [],
            error: '',
            loading: false,
            resultsHtml: '',
            count: 0,
            page: 1,
            lastPage: 1,
            deliveryOptions: [
                { value: 'online', label: 'Online', hint: 'Train from anywhere', icon: 'fa-video' },
                { value: 'in_person', label: 'In person', hint: 'Meet nearby', icon: 'fa-location-dot' },
                { value: 'both', label: 'Either', hint: 'I’m flexible', icon: 'fa-shuffle' }
            ],
            get selectedServiceLabels() {
                return servicesCatalog.filter((item) => this.services.includes(item.slug)).map((item) => item.title);
            },
            get deliverySummary() {
                const found = this.deliveryOptions.find((item) => item.value === this.delivery);
                return found ? found.label : '';
            },
            get matchSummary() {
                const n = this.count;
                const word = n === 1 ? 'wellness professional' : 'wellness professionals';
                return 'We found ' + n + ' ' + word + ' that match your preferences.';
            },
            isSelected(field, value) {
                return this[field].includes(value);
            },
            toggleValue(field, value) {
                const list = this[field];
                const index = list.indexOf(value);
                if (index === -1) {
                    list.push(value);
                } else {
                    list.splice(index, 1);
                }
                this.error = '';
            },
            chooseDelivery(value) {
                this.delivery = value;
                this.error = '';
                if (value === 'online') {
                    this.city = '';
                    this.state = '';
                    this.zip = '';
                    this.continueStep();
                }
            },
            validateStep() {
                if (this.step === 1 && this.services.length === 0) {
                    this.error = 'Pick at least one option to continue.';
                    return false;
                }
                if (this.step === 2 && !this.delivery) {
                    this.error = 'Choose Online, In person, or Either.';
                    return false;
                }
                if (this.step === 2 && this.delivery === 'in_person') {
                    if (!this.city.trim() || !this.state.trim()) {
                        this.error = 'Add your city and state so we can find nearby professionals.';
                        return false;
                    }
                }
                this.error = '';
                return true;
            },
            continueStep() {
                if (!this.validateStep()) {
                    return;
                }
                this.step = Math.min(3, this.step + 1);
            },
            back() {
                this.error = '';
                this.step = Math.max(1, this.step - 1);
            },
            editFilters() {
                this.phase = 'wizard';
                this.step = 1;
                this.error = '';
            },
            payload() {
                return {
                    services: this.services,
                    delivery: this.delivery,
                    city: this.city,
                    state: this.state,
                    zip: this.zip,
                    radius: this.radius,
                    goals: this.goals,
                    page: this.page
                };
            },
            async findMatches() {
                if (this.delivery === 'in_person' && (!this.city.trim() || !this.state.trim())) {
                    this.step = 2;
                    this.error = 'Add your city and state so we can find nearby professionals.';
                    return;
                }
                if (!this.delivery || this.services.length === 0) {
                    this.step = this.services.length === 0 ? 1 : 2;
                    this.error = 'Please finish the earlier questions first.';
                    return;
                }
                this.page = 1;
                await this.runSearch();
            },
            async goPage(next) {
                this.page = next;
                await this.runSearch();
            },
            async runSearch() {
                this.loading = true;
                this.error = '';
                try {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await fetch(searchUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(this.payload())
                    });
                    const data = await response.json();
                    if (!response.ok) {
                        const first = data.errors ? Object.values(data.errors)[0][0] : (data.message || 'Please check your answers and try again.');
                        this.error = first;
                        this.loading = false;
                        return;
                    }
                    this.count = data.count || 0;
                    this.resultsHtml = data.html || '';
                    this.page = data.current_page || 1;
                    this.lastPage = data.last_page || 1;
                    this.phase = 'results';
                    this.loading = false;
                    this.$nextTick(() => {
                        const el = this.$refs.results;
                        if (el && typeof el.scrollIntoView === 'function') {
                            el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                        }
                    });
                } catch (e) {
                    this.error = 'Something went wrong. Please try again.';
                    this.loading = false;
                }
            }
        };
    }
</script>
@endsection
