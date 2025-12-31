@extends('layouts.website.master')
@push('css')
    <style>
        .row-load-more{
            position: relative;
            display: flex;
            justify-content: center;
            width: 100%;
        }
        /*.row-load-more:before{*/
        /*    display:none;*/
        /*}*/
    </style>
@endpush
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
            <div class="row gallery-expand-buttons">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#rental" role="tab">RENTALS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#property" role="tab">PROPERTIES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#r-v" role="tab">Recreational vehicle (RV)</a>
                    </li>
                </ul>
            </div>
            <div class="row gallery-expands">
                <div class="col-md-12">
                    <div class="tab-content for-new-gallery">
                        <div class="tab-pane active row" id="rental" role="tabpanel">
                            <div class="row rental-deals">
                                @foreach($rentals as $rental)
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
                                                    <p>{!! \Illuminate\Support\Str::limit($rental->description,100) !!}</p>
                                                </div>
                                                <div class="dealz-box-price">
                                                    <div class="pricess">
                                                        <span>${{ number_format($rental->rent_per_day, 2) }} Per Day</span>
                                                    </div>
                                                    <div class="other-info-deals">
                                                        <div class="pro-detailz">
                                                            <img src="{{ asset('/assets/website/images/car-seats.png') }}" alt="">
                                                            <span>{{ $rental->hasProductDetails->seats }} Seats</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dealz-box-button">
                                                <a href="{{ route('rentals.single', $rental->slug) }}" class="dealz-box-a">BOOK NOW</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row-load-more for-deal-margin">
                                <a href="{{ route('product.show', 'rental') }}" class="load-more">Load more</a>
                            </div>
                        </div>
                        <div class="tab-pane  row" id="property" role="tabpanel">
                            <div class="row property-deal">
                                @foreach($models as $model)
                                    <div class="col-md-4">
                                        <div class="dealz-box">
                                            <div class="dealz-box-img">
                                                <img src="{{ asset('/admin/assets/products/thumbnails') }}/{{$model->thumbnail}}" alt="">
                                            </div>
                                            <div class="dealz-box-content">
                                                <div class="dealz-box-heading">
                                                    <h3>{{ $model->name }}</h3>
                                                    <img src="{{ asset('/assets/website/images/new-starz.png') }}" alt="">
                                                </div>
                                                <div class="dealz-box-description">
                                                    <p>{!! \Illuminate\Support\Str::limit($model->description,100) !!}</p>
                                                </div>
                                                <div class="dealz-box-price">
                                                    <div class="pricess">
                                                        <span>${{ number_format($model->rent_per_day, 2) }} Per Day</span>
                                                    </div>
                                                    <div class="other-info-deals">
                                                        <div class="pro-detailz">
                                                            <img src="{{ asset('/assets/website/images/washrooms-img.png') }}" title="Bathroom" alt="">
                                                            <span>{{ $model->hasProductDetails->bathrooms }} </span>
                                                        </div>
                                                        <div class="pro-detailz">
                                                            <img src="{{ asset('/assets/website/images/beds.png') }}" title="Bed" alt="">
                                                            <span>{{ $model->hasProductDetails->beds }}</span>
                                                        </div>
                                                        <div class="pro-detailz">
                                                            <span><i class="fa fa-home"></i></i> {{ $model->hasProductDetails->rooms }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dealz-box-button">
                                                <a href="{{ route('rentals.single', $model->slug) }}" class="dealz-box-a">BOOK NOW</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row-load-more for-deal-margin">
                                <a href="{{ route('product.show', 'property') }}" class="load-more">Load more</a>
                            </div>
                        </div>
                        <div class="tab-pane row" id="r-v" role="tabpanel">
                            <div class="row rental-deals">
                                @foreach($rvs as $rv)
                                    <div class="col-md-4">
                                        <div class="dealz-box">
                                            <div class="dealz-box-img">
                                                <img src="{{ asset('/admin/assets/products/thumbnails') }}/{{$rv->thumbnail}}" alt="">
                                            </div>
                                            <div class="dealz-box-content">
                                                <div class="dealz-box-heading">
                                                    <h3>{{ $rv->name }}</h3>
                                                    <img src="{{ asset('/assets/website/images/new-starz.png') }}" alt="">
                                                </div>
                                                <div class="dealz-box-description">
                                                    <p>{!! \Illuminate\Support\Str::limit($rv->description,100) !!}</p>
                                                </div>
                                                <div class="dealz-box-price">
                                                    <div class="pricess">
                                                        <span>${{ number_format($rv->rent_per_day, 2) }} Per Day</span>
                                                    </div>
                                                    <div class="other-info-deals">
                                                        <div class="pro-detailz">
                                                            <img src="{{ asset('/assets/website/images/car-seats.png') }}" alt="">
                                                            <span>{{ $rv->hasProductDetails->seats }} Seats</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dealz-box-button">
                                                <a href="{{ route('rentals.single', $rv->slug) }}" class="dealz-box-a">BOOK NOW</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row-load-more for-deal-margin">
                                <a href="{{ route('product.show', 'recreational-vehicle') }}" class="load-more">Load more</a>
                            </div>
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
