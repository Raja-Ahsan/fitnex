@extends('layouts.admin.app')
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('event.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body">
					<table class="table bordered">
						<tr>
							<th>Title</th>
							<td><span class="text-bold">{{ $event->title }}</span></td>
						</tr>
						<tr>
							<th>Host</th>
							<td>{!! $event->host !!}</td>
						</tr>
						<tr>
							<th>Date</th>
							<td>
								<span>{{ \Carbon\Carbon::parse($event->date)->format('l, F d, Y') }}</span>
							</td>
						</tr>
						<tr>
							<th>Time</th>
							<td>
								<span>
									{{
										str_replace(['am', 'pm'], ['a.m.', 'p.m.'],
											\Carbon\Carbon::parse($event->time)->format('g:i a')
										)
									}}
									until
									{{
										str_replace(['am', 'pm'], ['a.m.', 'p.m.'],
											\Carbon\Carbon::parse($event->end_time)->format('g:i a')
										)
									}}
								</span>
							</td>
						</tr>
						<tr>
							<th>Location</th>
							<td>
								@if(!empty($event->location_link))
									<a href="{{ $event->location_link }}" target="_blank">{{ $event->location }}</a>
								@else
									<span>{{ $event->location }}</span>
								@endif
							</td>
						</tr>
						<tr>
							<th>Registration Link</th>
							<td>
								<a href="{{ $event->registration_link }}" target="_blank">{{ $event->registration_link }}</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection