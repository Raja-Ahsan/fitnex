@extends('layouts.admin.app')

@section('title', $page_title)
@push('css')
@endpush
@section('content')
  <section class="content-header">
    <h1>Dashboard</h1>
  </section>

  <section class="content">
    <div class="row">
		<a href="{{ route('services.index') }}" style="pointer:cursor;">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-code-fork"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Services</span>
						<span class="info-box-number">{{$total_category}}</span>
					</div>
				</div>
			</div>                         
		</a>
		 <a href="{{ route('trainer.index') }}" style="pointer:cursor;">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Trainers</span>
						<span class="info-box-number">{{$total_trainer}}</span>
					</div>
				</div>
			</div>                         
		</a>
		<a href="{{ route('testimonial.index') }}" style="pointer:cursor;">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-star"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Testimonials</span>
						<span class="info-box-number">{{$testimonials}}</span>
					</div>
				</div>
			</div>                         
		</a>
		<a href="{{ route('contactus.index') }}" style="pointer:cursor;">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-blue"><i class="fa fa-address-book"></i></span>
				  <div class="info-box-content">
					<span class="info-box-text">Total Contact Us</span>
					<span class="info-box-number">{{$total_contactus}}</span>
				  </div>
				</div>
			</div>
		</a>
        {{-- <a href="{{ route('appointment.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-blue"><i class="fa fa-hand-o-right"></i></span>
				  <div class="info-box-content">
					<span class="info-box-text">Total Appointments</span>
					<span class="info-box-number">{{$total_appointments}}</span>
				  </div>
				</div>
			</div>
		</a> --}}
    </div>
  </section>
@endsection
