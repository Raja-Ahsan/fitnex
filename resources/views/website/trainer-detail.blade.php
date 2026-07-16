@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
    <style>
        .primary-theme-text {
            color: #00A3FF !important;
            /* Your primary theme color */
        }
    </style>
    <section class="inner-banner listing-banner"
        style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/' . $banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
        <div class="container">
            <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1]" {{-- data-aos="flip-right"
                data-aos-easing="linear" data-aos-duration="1500" --}}>
                @php
                    $title = ($banner && $banner->name) ? $banner->name : '';
                    $parts = explode(' ', $title, 2);
                @endphp
                <span class="italic uppercase font-black">
                    <span class="primary-theme-text">{{ $parts[0] }}</span>
                    @if(isset($parts[1]))
                        {{ $parts[1] }}
                    @endif
                </span>
            </h1>
        </div>
    </section>
  
    <section class="trainer-details-sec py-[50px] md:py-[100px] bg-black text-white">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-x-12">
                <div class="lg:col-span-2 trainer-image-box" {{-- data-aos="fade-right" data-aos-easing="linear"
                    data-aos-duration="1500" --}}>
                    @php
                        $image = $trainer->user->image ?? $trainer->image;
                    @endphp
                    @if ($image && file_exists(public_path('uploads/user/' . $image)))
                        <img src="{{ asset('uploads/user/' . $image) }}" class="rounded-lg trainer-details-img"
                            alt="{{ $trainer->name }}">
                    @elseif($image && file_exists(public_path('admin/assets/images/UserImage/' . $image)))
                        <img src="{{ asset('/admin/assets/images/UserImage/' . $image) }}" class="rounded-lg trainer-details-img"
                            alt="{{ $trainer->name }}">
                    @else
                        <img src="{{ asset('/admin/assets/images/Trainers/no-photo1.jpg') }}"
                            class="rounded-lg trainer-details-img" alt="{{ $trainer->name }}">
                    @endif
                </div>
                <div class="lg:col-span-3 trainer-info-box" {{-- data-aos="fade-left" data-aos-easing="linear"
                    data-aos-duration="1500" --}}>
                    <h2 class="text-4xl font-bold font-secondary">{{ $trainer->name }}</h2>
                    <p class="text-xl text-[#0079D4] font-secondary mb-4">{{ $trainer->designation }}</p>
                    @if($trainer->city && $trainer->state)
                        <p class="text-white">
                            <i class="fa-solid fa-location-dot mb-4 text-[#0079D4] mr-2"></i>{{ $trainer->city }},
                            {{ $trainer->state }}
                        </p>
                    @endif
                    @if(!empty($trainer->workplace) || !empty($trainer->gym_name))
                        <p class="text-white mb-4">
                            <i class="fa-solid fa-dumbbell text-[#0079D4] mr-2"></i>
                            @if(!empty($trainer->gym_name))
                                <span>{{ $trainer->gym_name }}</span>
                            @endif
                            @if(!empty($trainer->workplace) && !empty($trainer->gym_name))
                                <span class="text-white/50"> · </span>
                            @endif
                            @if(!empty($trainer->workplace))
                                <span class="text-white/80">{{ $trainer->workplace }}</span>
                            @endif
                        </p>
                    @endif
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            @php
                                $reviewCount = $trainer->reviews->count();
                                $avgRating = $reviewCount ? round($trainer->reviews->avg('rating'), 1) : 0;
                                $fullStars = (int) floor($avgRating);
                                $decimalPart = $avgRating - $fullStars;
                                $hasHalfStar = $reviewCount && $decimalPart >= 0.25 && $decimalPart < 0.75;
                                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                            @endphp
                            @if($reviewCount)
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @if($hasHalfStar)
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="fa-regular fa-star"></i>
                                @endfor
                            @else
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-regular fa-star"></i>
                                @endfor
                            @endif
                        </div>
                        <span class="ml-2 text-white">
                            @if($reviewCount)
                                ({{ number_format($avgRating, 1) }}/5.0) · {{ $reviewCount }} {{ Str::plural('review', $reviewCount) }}
                            @else
                                No reviews yet
                            @endif
                        </span>
                    </div>

                    <p class="para para-white mb-6">
                        {!! $trainer->description !!}
                    </p>
                    <h3 class="text-2xl font-bold font-secondary mb-3">Specialties:</h3>
                    <ul class="list-disc list-inside space-y-2 mb-6">
                        @php
                            $specializations = json_decode($trainer->specialization, true);
                        @endphp
                        @if (!empty($specializations))
                            @foreach ($specializations as $spec)
                                <li>{{ $spec }}</li>
                            @endforeach
                        @endif
                    </ul>
                    <h3 class="text-2xl font-bold font-secondary mb-3">Training Type:</h3>
                    <p class="text-white mb-4">{{ $trainer->trainer_type_display }}</p>
                    <h3 class="text-2xl font-bold font-secondary mb-3">Contact:</h3>
                    <div class="text-white space-y-2 mb-6">
                        @if($trainer->email)
                            <p><i class="fa-solid fa-envelope text-[#0079D4] mr-2"></i><a href="mailto:{{ $trainer->email }}"
                                    class="text-white hover:text-[#0079D4]">{{ $trainer->email }}</a></p>
                        @endif
                        @if($trainer->phone)
                            <p><i class="fa-solid fa-phone text-[#0079D4] mr-2"></i><a href="tel:{{ $trainer->phone }}"
                                    class="text-white hover:text-[#0079D4]">{{ $trainer->phone }}</a></p>
                        @endif
                        @if($trainer->instagram)
                            <p><i class="fa-brands fa-instagram text-[#0079D4] mr-2"></i><a href="{{ $trainer->instagram }}"
                                    target="_blank" class="text-white hover:text-[#0079D4]">{{ $trainer->instagram }}</a></p>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-3xl font-bold font-secondary"><span
                                class="primary-theme">${{ $trainer->price }}</span> <span class="text-base font-normal">/
                                session</span></p>

                        <a href="{{ route('appointments.create', ['trainer_id' => $trainer->id]) }}"
                            class="btn primary-btn">Book a Session</a>
                    </div>

                    @if(session('message'))
                        <p class="text-green-400 mt-4">{{ session('message') }}</p>
                    @endif

                    <h3 class="text-2xl font-bold font-secondary mb-3 mt-10">Leave a review</h3>
                    <p class="para para-white mb-4">Share your experience after working with {{ $trainer->name }}. Your review will be visible on this profile after admin approval.</p>
                    <form action="{{ route('trainer.review.store', $trainer->id) }}" method="post" class="space-y-4">
                        @csrf
                        <div>
                            <label for="reviewer_name" class="block text-white font-secondary mb-1">Your name</label>
                            <input type="text" name="reviewer_name" id="reviewer_name" class="input-field w-full max-w-md" placeholder="Your name" required value="{{ old('reviewer_name') }}">
                            @error('reviewer_name')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="reviewer_email" class="block text-white font-secondary mb-1">Your email</label>
                            <input type="email" name="reviewer_email" id="reviewer_email" class="input-field w-full max-w-md" placeholder="your@email.com" required value="{{ old('reviewer_email') }}">
                            @error('reviewer_email')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="rating" class="block text-white font-secondary mb-1">Rating (1–5 stars)</label>
                            <select name="rating" id="rating" class="input-field w-full max-w-md" required>
                                <option value="">Select rating</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" @if((int) old('rating') === $i) selected @endif>{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                            @error('rating')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="comment" class="block text-white font-secondary mb-1">Your review (optional)</label>
                            <textarea name="comment" id="comment" class="input-field w-full max-w-md" rows="4" placeholder="Tell others about your experience...">{{ old('comment') }}</textarea>
                            @error('comment')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn primary-btn">Submit review</button>
                    </form>

                    @if($trainer->reviews->count() > 0)
                        <h3 class="text-2xl font-bold font-secondary mb-3 mt-10">Reviews</h3>
                        <div class="space-y-4">
                            @foreach($trainer->reviews as $review)
                                <div class="border border-gray-700 rounded-lg p-4">
                                    <div class="flex text-yellow-400 mb-2">
                                                @for($i = 0; $i < $review->rating; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @for($i = 0; $i < 5 - $review->rating; $i++)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor
                                    </div>
                                    @if($review->comment)
                                        <p class="para para-white mb-2">{{ $review->comment }}</p>
                                    @endif
                                    <span class="text-white font-secondary font-bold">{{ $review->reviewer_name }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection