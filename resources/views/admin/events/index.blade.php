@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('event.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	@can('event-create')
	<div class="content-header-right">
		<a href="{{ route('event.create') }}" class="btn btn-primary btn-sm">Add event</a>
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
							<input type="text" id="search" class="form-control" placeholder="Search">
						</div>
						<div class="d-flex col-sm-5">
							<select name="" id="status" class="form-control status" style="margin-bottom:5px">
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
									<th>SL</th>
									<th>Title</th>
									<th>Host</th>
									<th>Date</th>
									<th>Time</th>
									<th>Location</th> 
									<th>Registration Link</th>
									<th>Status</th>
									<th width="140">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($models as $key=>$event)
								<tr id="id-{{ $event->id }}">
									<td>{{ $models->firstItem()+$key }}.</td>
									<td>{!! \Illuminate\Support\Str::limit($event->title,40) !!}</td>
									<td>{!! \Illuminate\Support\Str::limit($event->host,60) !!}</td>
									<td>{!! \Carbon\Carbon::parse($event->date)->format('d-m-Y') !!}</td>
									<td>{!! \Carbon\Carbon::parse($event->time)->format('h:i A') !!} - {!! \Carbon\Carbon::parse($event->end_time)->format('h:i A') !!}</td>
									{{-- <td>
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->location) }}" target="_blank">
                                            {!! \Illuminate\Support\Str::limit($event->location,60) !!}
                                        </a>
                                    </td> --}}
									<td>
										@if(!empty($event->location_link))
											<a href="{{ $event->location_link }}" target="_blank">{{ $event->location }}</a>
										@else
											<span>{{ $event->location }}</span>
										@endif
									</td>
									<td><a href="{{ $event->registration_link }}" target="_blank">{{ $event->registration_link }}</a></td>
									<td>
										@if($event->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td width="250px">
										<a href="{{route('event.show', $event->id)}}" data-toggle="tooltip" data-placement="top" title="Show event" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a>
										@can('event-edit')
										<a href="{{route('event.edit', $event->id)}}" data-toggle="tooltip" data-placement="top" title="Edit event" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('event-delete')
										<button class="btn btn-danger btn-xs delete" data-slug="{{ $event->id }}" data-del-url="{{ url('event', $event->id) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="9">
										Displying {{$models->firstItem()}} to {{$models->lastItem()}} of {{$models->total()}} records
										<div class="d-flex justify-content-center">
											{!! $models->links('pagination::bootstrap-4') !!}
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