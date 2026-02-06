@extends('layouts.admin.app')
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('trainer.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table bordered">
					<tr>
						<th>Image</th>
						<td>
							@if($trainer->image)
								<img src="{{ asset('/admin/assets/images/Trainers/'.$trainer->image) }}" alt="vehicle Image" height="400px" width="500px">
							@else 
								<img src="{{ asset('/admin/assets/images/Trainers/no-photo1.jpg') }}" alt="vehicle Image" height="400px" width="500px">
							@endif
						</td>
					</tr>
					<tr>
						<th>Name</th>
						<td><span class="badge badge-success">{{ $trainer->name }}</span></td>
					</tr>
					<tr>
						<th>Trainer Type</th>
						<td>{{ $trainer->trainer_type }}</td>
					</tr>
					<tr>
						<th>Designation</th>
						<td>{!! $trainer->designation !!}</td>
					</tr>
					<tr>
						<th>Description</th>
						<td>{!! $trainer->description !!}</td>
					</tr>
					<tr>
						<th>Price</th>
						<td>{{ $trainer->price }}</td>
					</tr>
					<tr>
						<th>Rating</th>
						<td>
							<div class="rating-stars">
								@for($i = 1; $i <= 5; $i++)
									@if($i <= $trainer->rating)
										<i class="fas fa-star text-warning"></i>
									@else
										<i class="far fa-star"></i>
									@endif
								@endfor
							</div>
						</td>
					</tr>
					<tr>
						<th>Specialization</th>
						<td>
							@if($trainer->specialization)
								@foreach(json_decode($trainer->specialization, true) as $specialization)
									<li class="list-inline-item">{{ $specialization }}</li>
								@endforeach
							@endif
						</td>
					</tr>
					<tr>
						<th>City</th>
						<td>{{ $trainer->city->city ?? 'N/A' }}</td>
					</tr>
					<tr>
						<th>State</th>
						<td>{{ $trainer->state->state ?? 'N/A' 	}}</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>{{ $trainer->email ?? 'N/A' }}</td>
					</tr>
					<tr>
						<th>Phone</th>
						<td>{{ $trainer->phone ?? 'N/A' }}</td>
					</tr>
					<tr>
						<th>Instagram</th>
						<td>{{ $trainer->instagram ?? 'N/A' }}</td>
					</tr>
					<tr>
						<th>Google Calendar ID</th>
						<td>{{ $trainer->google_calendar_id ?? 'N/A' }}</td>
					</tr>
					<tr>
						<th>Status</th>
						<td>
							@if($trainer->status)
								<span class="badge badge-success">Active</span>
							@else 
								<span class="badge badge-danger">In-Active</span>
							@endif
						</td>
					</tr>
					<tr>
						<th>Date</th>
						<td>
								<span class="badge badge-success">{{ date('d, F-Y H:i:s A', strtotime($trainer->created_at)) }}</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>


@endsection