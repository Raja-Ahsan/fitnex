@extends('layouts.website.master')
@section('title', $page_title)
@section('content')

<section class="inner-banner listing-banner" style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/'.$banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
    <div class="container">
        <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1]">
            @php
                $title = ($banner && $banner->name) ? $banner->name : 'Terms of Service';
                $parts = explode(' ', $title, 2);
            @endphp
            <span class="italic uppercase font-black">
                <span class="primary-theme-text">{{ $parts[0] }}</span>@if(isset($parts[1])) {{ $parts[1] }}@endif
            </span>
        </h1>
    </div>
</section>

@include('website.partials.legal-page-content', [
    'eyebrow' => 'Terms',
    'heading' => $home_page_data['term_heading'] ?? 'Terms of Service',
    'content' => $home_page_data['term_content'] ?? '',
])

@endsection
