@php
    $bio = trim(strip_tags($trainer->description ?? ''));
    if ($bio === '') {
        $bio = 'Passionate about helping you build confidence and achieve peak performance.';
    }
    $specs = $trainer->specialization_list;
    $location = $trainer->location_label;
    $delivery = $trainer->delivery_label;
    $rawType = (string) ($trainer->getAttributes()['trainer_type'] ?? '');
    $serviceTitles = [];
    if ($rawType !== '') {
        foreach (array_filter(array_map('trim', explode(',', $rawType))) as $part) {
            $cat = $categories[$part] ?? $categories->firstWhere('title', $part);
            $serviceTitles[] = $cat->title ?? $part;
        }
    }
    $serviceTitles = array_values(array_unique($serviceTitles));
    $role = $trainer->designation ?: ($serviceTitles[0] ?? 'Wellness Professional');
@endphp

<article class="trainer-profile-card flex flex-col h-full">
    <a href="{{ route('trainer.detail', $trainer->id) }}" class="block no-underline group">
        <div class="relative w-full overflow-hidden bg-neutral-900" style="aspect-ratio: 4/5;">
            <img src="{{ $trainer->public_image_url }}"
                class="absolute inset-0 w-full h-full object-cover object-center"
                alt="{{ $trainer->name }}" loading="lazy">
        </div>
    </a>

    <div class="flex flex-col flex-1 px-4 sm:px-5 pt-4 pb-5 text-center">
        <a href="{{ route('trainer.detail', $trainer->id) }}" class="no-underline">
            <h3 class="text-lg sm:text-xl font-bold text-[var(--ot-accent)] leading-tight mb-1.5 break-words">
                {{ $trainer->name }}
            </h3>
        </a>
        <p class="text-white text-sm sm:text-[15px] font-medium mb-2 break-words">
            {{ $role }}
        </p>

        @if($serviceTitles !== [])
            <p class="text-[var(--ot-muted)] text-xs mb-2">{{ implode(' · ', $serviceTitles) }}</p>
        @endif

        @if($location !== '' || $delivery !== '')
            <p class="text-[var(--ot-muted)] text-xs mb-2">
                @if($location !== '')
                    <i class="fa-solid fa-location-dot text-[var(--ot-accent)] me-1" aria-hidden="true"></i>{{ $location }}
                @endif
                @if($location !== '' && $delivery !== '')
                    <span class="mx-1">·</span>
                @endif
                @if($delivery !== '')
                    <i class="fa-solid fa-video text-[var(--ot-accent)] me-1" aria-hidden="true"></i>{{ $delivery }}
                @endif
            </p>
        @endif

        @if($specs !== [])
            <p class="text-[var(--ot-muted)] text-[11px] mb-2">{{ implode(', ', array_slice($specs, 0, 4)) }}</p>
        @endif

        <div class="w-10 h-[2px] bg-[var(--ot-accent)] mx-auto mb-3"></div>
        <p class="text-[var(--ot-muted)] text-xs sm:text-sm leading-relaxed mb-4 flex-1 line-clamp-3">
            {{ Str::limit($bio, 120) }}
        </p>
        <a href="{{ route('trainer.detail', $trainer->id) }}"
            class="btn primary-btn border border-transparent text-sm py-2.5 px-4 min-h-[44px] inline-flex items-center justify-center mt-auto">
            View Profile
        </a>
    </div>
</article>
