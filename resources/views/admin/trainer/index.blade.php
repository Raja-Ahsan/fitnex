@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('trainer.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{$page_title}}</h1>
	</div>
	@can('trainer-create')
	<div class="content-header-right">
		<a href="{{ route('trainer.create') }}" class="btn btn-primary btn-sm">Add Trainer</a>
	</div>
	@endcan
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			@if (session('status'))
			<div class="callout callout-success">
				{{ session('status') }}
			</div>
			@endif
			<div class="box box-info">
				<div class="box-body">
					<div class="row">
						<div class="col-sm-1">Search:</div>
						<div class="d-flex col-sm-6">
							<input type="text" id="search" class="form-control" placeholder="Search by name">
						</div>
						<div class="d-flex col-sm-5">
							<select name="status" id="status" class="form-control status" style="margin-bottom:5px">
								<option value="All" selected>Search by status</option>
								<option value="1">Active</option>
								<option value="2">In-Active</option>
							</select>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<table id="" class="table table-hover table-bordered">
							<thead>
								<tr>
									<th width="30">SL</th>
									<th>Image</th>
									<th>Trainer Type</th>
									<th>Name</th>
									<th>Designation</th>
									{{-- <th>Email</th>
									<th>Phone</th> --}}
									<th>Description</th>
									<th>Price</th> 
									<th>Rating</th>
									<th>Specialization</th> 
									<th>Instagram</th> 
									<th>Google Calendar ID</th>
									<th>Status</th>
									<th>Created by</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($trainers as $key=>$trainer)
								<tr id="id-{{ $trainer->slug }}">
									<td>{{ $trainers->firstItem()+$key }}.</td>
									<td>
										@if($trainer->image)
										<img src="{{ asset('/admin/assets/images/Trainers/'.$trainer->image) }}" alt="" style="width:60px;">
										@else
										<img src="{{ asset('/admin/assets/images/Trainers/no-photo1.jpg') }}" style="width:60px;">
										@endif
									</td>
									<td>{{ $trainer->trainer_type }}</td>
									<td>{{ $trainer->name }}</td>
									<td>{{ $trainer->designation }}</td>
									{{-- <td>{{ $trainer->email }}</td>
									<td>{{ $trainer->phone }}</td> --}}
									<td style="max-width: 200px;">{{ $trainer->description }}</td>
									<td>${{ $trainer->price }}</td> 
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
									<td>
										@if($trainer->specialization)
											@foreach(json_decode($trainer->specialization, true) as $specialization)
												<li class="list-inline-item">{{ $specialization }}</li>
											@endforeach
										@endif
									</td> 
									<td>{{ $trainer->instagram }}</td> 
									<td>{{ $trainer->google_calendar_id }}</td>
									<td>
										@if($trainer->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td>{{isset($trainer->hasCreatedBy)?$trainer->hasCreatedBy->name:'N/A'}}</td>
									<td style="max-width: 100px;">
										<div style="display: flex; gap: 5px;">
											@can('trainer-edit')
											<a href="{{route('trainer.edit', $trainer->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Trainer" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
											@endcan
											@can('trainer-delete')
											<button class="btn btn-danger btn-xs delete" data-slug="{{ $trainer->id }}" data-del-url="{{ url('trainer', $trainer->id) }}" data-toggle="tooltip" data-placement="top" title="Delete Trainer"><i class="fa fa-trash"></i></button>
											@endcan
										</div>
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="13">
										Displying {{$trainers->firstItem()}} to {{$trainers->lastItem()}} of {{$trainers->total()}} records
										<div class="d-flex justify-content-center">
											{!! $trainers->links('pagination::bootstrap-4') !!}
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@push('js')
@endpush