@extends(((Auth::user()->hasRole('Admin')) ? 'layouts.admin.app' : 'layouts.member.app'))
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('advertisement.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{$page_title}}</h1>
	</div>
	@can('advertisement-create')
	<div class="content-header-right">
		<a href="{{ route('advertisement.create') }}" class="btn btn-primary btn-sm">Add Advertisement</a>
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
						<div class="d-flex col-sm-7">
							<input type="text" id="search" class="form-control" placeholder="Search by Name">
						</div>
						<div class="d-flex col-sm-4">
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
									<th>Image</th>
									<th>Name</th>
									<th>Short Description</th>
									<th>State</th>
									<th>City</th>
									<th>Status</th>
									<th>Created by</th>
									<th width="140">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($advertisements as $key=>$advertisement)
								<tr id="id-{{ $advertisement->id }}">
									<td>{{ $advertisements->firstItem()+$key }}.</td>
									<td>
										@if($advertisement->image)
										<img src="{{ asset('/admin/assets/images/advertisement') }}/{{ $advertisement->image }}" style="width:60px;" alt="">
										@else
										<img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
										@endif
									</td>
									<td>{{ $advertisement->name }}</td>
									<td>{!! \Illuminate\Support\Str::limit( $advertisement->short_description , 20) !!}</td>
									<!-- Fetch city name -->
									<td>{{ $advertisement->hasCity ? $advertisement->hasCity->city : 'N/A' }}</td>
									<!-- Fetch state name -->
									<td>{{ $advertisement->hasState ? $advertisement->hasState->state : 'N/A' }}</td>
									<td>
										@if($advertisement->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td>{{isset($advertisement->hasCreatedBy)?$advertisement->hasCreatedBy->name:'N/A'}}</td>
									<td width="250px">
										@can('advertisement-edit')
										<a href="{{route('advertisement.edit', $advertisement->id)}}" data-toggle="tooltip" data-placement="top" title="Edit advertisement" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('advertisement-delete')
										<button class="btn btn-danger btn-xs delete" data-slug="{{ $advertisement->id }}" data-del-url="{{ url('advertisement', $advertisement->id) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="9">
										<div class="d-flex justify-content-center">
											{!! $advertisements->links('pagination::bootstrap-4') !!}
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