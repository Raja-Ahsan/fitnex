@extends('layouts.website.master')
@section('content')
<!-- BANNER SEC -->
    <section class="banner-imnner-about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="iner-baner-head">
                        <h1>{{$banner[12]->name}}</h1>
                        <p class="extra-text">{{$banner[12]->short_description}}</p>
                        <p>{!! $banner[12]->description !!}</p>
                    </div>    
                </div>
            </div>
        </div>
    </section>
    <!-- BANNER SEC -->
        <section class="blogs-article">
            <div class="container">
                <div class="row">
                    <div class="blogs-article-first-row">
                        <h3>Lorem ipsum dolor</h3>
                        <h1>BLOGS & ARTICLE</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-md-4">
                        <div class="blog-box">
                            <div class="blog-img-box">
                                <img src="{{ asset('/admin/assets/posts') }}/{{$blog->post}}" alt="">
                            </div>
                            <div class="blog-content-box">
                                <h3>{{$blog->title}}</h3>
                                <p>{!! $blog->description !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row justify-content-center row-load-more for-deal-margin mt-0">
                    <a href="" class="load-more">Load more</a>
                </div>
            </div>
        </section>
@endsection
