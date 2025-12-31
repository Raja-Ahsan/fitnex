@extends('layouts.website.master')
@section('content')
    <!-- BANNER SEC -->
    <section class="rentals-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="iner-baner-head">
                        <h1>{{$banner->name}}</h1>
                        <p class="extra-text">{!! $banner->short_description !!}</p>
                        <p>{!! $banner->description !!}</p>
                    </div>    
                </div>
            </div>
        </div>
    </section>
    <!-- BANNER SEC -->
    <!-- RENTAL TYPE SEC -->
    <section class="rental-types">
        <div class="container">
            <div class="row gallery-expands">
                <div class="col-md-12">
                    <div class="tab-content for-new-gallery">
                        <div class="row rental-deals">
                            @foreach($products as $rental)
                                <div class="col-md-4">
                                    <div class="dealz-box">
                                        <div class="dealz-box-img">
                                            <img src="{{ asset('/admin/assets/products/thumbnails') }}/{{$rental->thumbnail}}" alt="">
                                        </div>
                                        <div class="dealz-box-content">
                                            <div class="dealz-box-heading">
                                                <h3>{{ $rental->name }}</h3>
                                                <img src="{{ asset('/assets/website/images/new-starz.png') }}" alt="">
                                            </div>
                                            <div class="dealz-box-description">
                                                <p>{!! Str::limit($rental->description , 20) !!}</p>
                                            </div>
                                            <div class="dealz-box-price">
                                                <div class="pricess">
                                                    <span>${{ number_format($rental->rent_per_day, 2) }} Per Day</span>
                                                </div>
                                                @if($rental->category_slug == 'property')
                                                    <div class="other-info-deals">
                                                        <div class="pro-detailz">
                                                            <span><i class="fa fa-home"></i> {{ $rental->hasProductDetails->rooms }} Rooms</span>
                                                        </div>
                                                    </div>
                                                @else 
                                                    <div class="other-info-deals">
                                                        <div class="pro-detailz">
                                                            <img src="{{ asset('/assets/website/images/car-seats.png') }}" alt="">
                                                            <span>{{ $rental->hasProductDetails->seats }} Seats</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="dealz-box-button">
                                            <a href="{{ route('rentals.single', $rental->slug) }}" class="dealz-box-a">BOOK NOW</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-center row-load-more for-deal-margin">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- RENTAL TYPE SEC -->
    @endsection

    @push('js')
     <script>
        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var pageurl = $('#page_url_rental').val();
            var page = $(this).attr('href').split('page=')[1];
            fetchAll(pageurl, page);
        });
        function fetchAll(pageurl, page){
            $.ajax({
                url:pageurl+'?page='+page,
                type: 'get',
                success: function(response){
                    $('#body').html(response);
                }
            });
        }
    </script>
    @endpush
