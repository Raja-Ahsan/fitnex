 @extends('layouts.website.master')
@push('css')
<!-- BANNER SLIDER LINK  -->
	<style>
	.slick-slide img{
		height:550px !important;
		object-fit:cover !important;
	}
	.ui.input input{
		max-width:90% !important;
	}
	.product-detial .form-group.col-md-6 input[type="time"] {padding: 17px 5px;}
	.modals.dimmer .ui.scrolling.modal{height:auto !important;}
	</style>
<!-- date sheet link -->
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!-- SLIDER BANNER  -->
    <section class="banner-slider details">
        <div class="container-fluid">
            <div class="row">
				<div class="col-md-12 slider">
				    @foreach($product->hasProductImages as $key=>$image)
                        <div class="item active">
                            <img class="carousel-image" src="{{asset('/admin/assets/products/images') }}/{{ $image->image }}" alt="banner 1">
                        </div>
                    @endforeach
				</div>
			<div>
        </div>
    </section>
    <!-- SLIDER BANNER HTML -->
    <!-- PRODUCT DETIAL  -->
    <section class="product-detial">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="detial">
                        <h1>{{ $product->name }}</h1>
                        <p>{!! $product->description !!}</p>
                        <!--<div class="ranking">-->
                        <!--    <span>4.92</span>  -->
                        <!--    <img src="{{ asset('/assets/website/images/testimonials-single-star.png') }}" alt="">-->
                        <!--    <p>(73 tip)</p>-->
                        <!--</div>-->
                        @if($product->category_slug != 'property')
                            <div class="labeledBadge">
                                <div class="value-icon">
                                    <span class="icon--economy"></span>
                                    <span>{{ $product->hasProductDetails->mpg }} MPG</span>
                                </div>  
                                <div class="value-icon">
                                    <span class="icon--gas"></span>
                                    <span>{{ $product->hasProductDetails->fuel }} Fuel</span>
                                </div>  
                            </div>
                            <div class="labeledBadge">
                                <div class="value-icon">
                                    <span class="icon--door"></span>
                                    <span>{{ $product->hasProductDetails->doors }} Doors</span>
                                </div>  
                                <div class="value-icon">
                                    <span class="icon--seat"></span>
                                    <span>{{ $product->hasProductDetails->seats }} Seats</span>
                                </div>  
                            </div>
                        @else 
                            <div class="labeledBadge">
                                <div class="value-icon">
                                    <span class="fa fa-home"></span>
                                    <span>{{ $product->hasProductDetails->rooms }} Rooms</span>
                                </div>  
                                <div class="value-icon">
                                    <span class="fa fa-hotel"></span>
                                    <span>{{ $product->hasProductDetails->beds }} Beds</span>
                                </div>  
                            </div>
                            <div class="labeledBadge">
                                <div class="value-icon">
                                    <img src="{{ asset('/assets/website/images/washrooms-img.png') }}" title="Bathroom" alt="">
                                    <span>{{ $product->hasProductDetails->bathrooms }} Bathrooms</span>
                                </div>   
                                <div class="value-icon">
                                   
                                </div>   
                            </div>
                        @endif
                    </div>
                    <div class="hosted">
                        <h6>HOSTED BY</h6>
                        <img src="{{ asset('/assets/website/images/chef-logo.png') }}" alt="">
                        <!--<div class="hosted-rank">-->
                        <!--    <span>4.9-->
                        <!--        <a href=""> <img src="{{ asset('/assets/website/images/testimonials-single-star.png') }}" alt=""> </a></span>-->
                        <!--</div>-->
                        <div class="hosted-info">
                            <h3>Susanna</h3>
                            <span>All-Star Host</span>
                            <p>564 tripsJoined Jul 2014</p>
                            <h6>Typically responds within 1 minute</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="data-time d-flex justify-content-between align-items-center">
                        <h1>${{ number_format($product->rent_per_day, 2) }}<span>/Per Day</span></h1>
						<span style="font-size:14px;">Central Time - USA</span>
                    </div>
                    <hr>
                    <form action="{{ route('booking.store') }}" id="booking-form" method="post">
                        @csrf

						<input type="hidden" name="is_deal" value="0">
                        <input type="hidden" name="product_slug" value="{{ $product->slug }}">
                        <input type="hidden" name="per_day_rent" value="{{ $product->rent_per_day }}">
                        <h3>Trip start</h3>
                        <div class="date-picker row">
                            <div class="form-group col-md-6 ui calendar" id="example2">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" autocomplete="off" id="sdatepicker" name="trip_start_date" class="datepicker" placeholder="Date" required>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-6">
								<input type="time" class="form-control" name="trip_start_time" autocomplete="off" id="datetimepicker111" value="" data-date-format="HH:mm" placeholder="choose time">
								<span style="color: red"></span>
							</div>
                        </div>
                        <h3>Trip End</h3>
                        <div class="date-picker row">
                            <div class="form-group col-md-6 ui calendar" id="example33">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" name="trip_end_date" autocomplete="off" class="datepicker" placeholder="Date" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
								<input type="time" class="form-control" name="trip_end_time" autocomplete="off" id="datetimepicker111" value="" data-date-format="HH:mm" placeholder="choose time">
								<span style="color: red"></span>
							</div>
                            
                        </div>

                        <h3>Pickup Location</h3>
                        <div class="pick-location">
                            <label for="city">State</label><span style="color: red">*</span>
                            <div class="form-group">
                                <select name="pickup_city_id" id="pickup_city_id" class="form-control" required>
                                    <option value="" selected>Select State</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                    @endforeach
                                </select>
								<span style="color: red">{{ $errors->first('pickup_city_id') }}</span>
                            </div>
							<label for="" class="control-label">Time Zone<span style="color: red">*</span></label>
								<div class="form-group">
									<select name="pick_time_zone" id="pick_time_zone" class="form-control pick_time_zone">
										<option value="" selected>Select Time Zone</option>
										@foreach ($cities as $city)
											<option value="{{ $city->id }}" {{ old('pick_time_zone')==$city->id?'selected':'' }}>{{ $city->time_zone }}</option>
										@endforeach
									</select>
									<span style="color: red">{{ $errors->first('pick_time_zone') }}</span>
								</div>
							
                            <label for="state">City</label><span style="color: red">*</span>
                            <div class="form-group">
                                <select name="pickup_state" id="pickup_state" class="form-control" required>
                                    <option value="" selected>Select City</option>
                                </select>
								<span style="color: red">{{ $errors->first('pickup_state') }}</span>
                            </div>
                            <label for="pickup_address">Address</label><span style="color: red">*</span>
                            <div class="form-group">
                                <textarea name="pickup_address" id="pickup_address" cols="30" rows="3" class="form-control" placeholder="Enter local address" required></textarea>
								<span style="color: red">{{ $errors->first('pickup_address') }}</span>
                            </div>
                        </div>
                        <h3>Drop Location</h3>
                        <div class="pick-location">
                            <label for="city">State</label><span style="color: red">*</span>
                            <div class="form-group">
                                <select name="drop_city_id" id="drop_city_id" class="form-control" required>
                                    <option value="" selected>Select State</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                    @endforeach
                                </select>
								<span style="color: red">{{ $errors->first('drop_city_id') }}</span>
                            </div>
							<label for="" class="control-label">Time Zone<span style="color: red">*</span></label>
								<div class="form-group">
									<select name="drop_time_zone" id="drop_time_zone" class="form-control drop_time_zone">
										<option value="" selected>Select Time Zone</option>
										@foreach ($cities as $city)
											<option value="{{ $city->id }}" {{ old('drop_time_zone')==$city->id?'selected':'' }}>{{ $city->time_zone }}</option>
										@endforeach
									</select>
									<span style="color: red">{{ $errors->first('drop_time_zone') }}</span>
								</div>
                            <label for="state">City</label><span style="color: red">*</span>
                            <div class="form-group">
                                <select name="drop_state_id" id="drop_state" class="form-control" required>
                                    <option value="" selected>Select City</option>
                                </select>
								<span style="color: red">{{ $errors->first('drop_state_id') }}</span>
                            </div>
                            <label for="drop_address">Address</label><span style="color: red">*</span>
                            <div class="form-group">
                                <textarea name="drop_address" id="drop_address" cols="30" rows="3" class="form-control" placeholder="Enter local address" required></textarea>
								<span style="color: red">{{ $errors->first('drop_address') }}</span>
                            </div>
                        </div>
                        <div class="continue-btn">
                            <button type="submit" class="universal-btn continue-btn">Continue</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
        <!--<div class="ui modal test" id="login-modal">-->
        <!--  <i class="close icon"></i>-->
        <!--  <div class="header"><i class="fa fa-key"></i> Login</div>-->
        <!--  <div class="image content">-->
        <!--    <div class="description">-->
        <!--      <div class="ui header">We've auto-chosen a profile image for you.</div>-->
        <!--      <p>We've grabbed the following image from the <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your registered e-mail address.</p>-->
        <!--      <p>Is it okay to use this photo?</p>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="actions">-->
        <!--    <div class="ui black deny button">-->
        <!--      Cancel-->
        <!--    </div>-->
        <!--    <div class="ui positive right labeled icon button">-->
        <!--      Login-->
        <!--      <i class="checkmark icon"></i>-->
        <!--    </div>-->
        <!--  </div>-->
        </div>
    </section>
    <!-- PRODUCT DETIAL  -->
    @endsection

    @push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
    <script>
        // $('#booking-form').on('submit', function(e) {
        //   e.preventDefault(); 
        //   var loggedIn = {{ auth()->check() ? 'true' : 'false' }};
        //     if (loggedIn){
        //         alert('Logged In as user!');
        //     }else{
        //         $('#login-modal').modal('show');
        //     }
        // });
    
		var today = new Date();
        $('#example2').calendar({
			type: 'date',
			minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - -1),
        });
		var today2 = new Date();
        $('#example33').calendar({
			type: 'date',
			minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - -2),
        });
    
        $(document).on('change', '#pickup_city_id', function(){
            var city_id = $(this).val();
            $.ajax({
                url : "{{ route('get_states') }}",
                data : {'city_id' : city_id},
                type : 'GET',
                success : function(response){
                    var html = '';
                    $.each(response, function(item, val) {
                        html += '<option value="'+val.id+'">'+val.state+'</option>';
                    });
                    $('#pickup_state').html(html);

                }
            });
        });
        $(document).on('change', '#drop_city_id', function(){
            var city_id = $(this).val();
            $.ajax({
                url : "{{ route('get_states') }}",
                data : {'city_id' : city_id},
                type : 'GET',
                success : function(response){
                    var html = '';
                    $.each(response, function(item, val) {
                        html += '<option value="'+val.id+'">'+val.state+'</option>';
                    });
                    $('#drop_state').html(html);
                }
            });
        });
    </script>
    @endpush
