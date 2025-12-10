@if (Auth::user()->hasRole('Member'))
    @extends('layouts.member.app')
@endif

@section('title', $page_title)
@section('content')
  <section class="content-header">
	<h1 style="color:#c98900 !important; font-weight: 700;">{{ Auth::user()->role}} Dashboard</h1>
  </section>
  <section class="content">
    <div class="row">
		<!-- {{-- <a href="{{ route('property.index') }}" style="pointer:cursor;">
			<div class="col-md-6">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-home" aria-hidden="true"></i></span>
					<div class="info-box-content" style="background: #ddd1d142 !important;">
						<span class="info-box-text" style="color: #000 !important;">Total Properties</span>
						<span class="info-box-number" style="color: #000 !important;font-weight: 600;">{{$total_properties}}</span>
					</div>
				</div>
			</div>
		</a> --}} -->
		<!-- {{--<a href="{{ route('contact.index') }}" style="pointer:cursor;">
			<div class="col-md-6">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-address-book" aria-hidden="true"></i></span>
					<div class="info-box-content" style="background: #ddd1d142 !important;">
						<span class="info-box-text" style="color: #000 !important;"> Total Contact Us</span>
						<span class="info-box-number" style="color: #000 !important;font-weight: 600;">{{$total_contact}}</span>
					</div>
				</div>
			</div>
		</a>
		<a href="{{ route('client_contact.index') }}" style="pointer:cursor;">
			<div class="col-md-6">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-users" aria-hidden="true"></i></span>
					<div class="info-box-content" style="background: #ddd1d142 !important;">
						<span class="info-box-text" style="color: #000 !important;"> Total Client Contacts</span>
						<span class="info-box-number" style="color: #000 !important;font-weight: 600;">{{$total_client_contact}}</span>
					</div>
				</div>
			</div>
		</a>--}} -->
    </div>
  </section>
@endsection
