@php
    $heading = $heading ?? '';
    $content = $content ?? '';
    $eyebrow = $eyebrow ?? 'FITNEX Legal';
@endphp

@include('website.partials.legal-page-styles')

<section class="legal-page">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="legal-page__card" data-aos="fade-up" data-aos-duration="800">
            <p class="legal-page__eyebrow">{{ $eyebrow }}</p>
            <div class="legal-page__title">
                {!! $heading ?: 'Legal Information' !!}
            </div>

            @if (trim(strip_tags((string) $content)) !== '')
                <div class="legal-prose">
                    {!! $content !!}
                </div>
            @else
                <p class="legal-page__empty">Content will be published here soon. Please check back later.</p>
            @endif
        </div>
    </div>
</section>
