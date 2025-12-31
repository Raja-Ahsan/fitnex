@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.contractor.app')))
@section('title', $page_title)
@section('content')

<input type="hidden" id="page_url" value="{{ route('package.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	@can('package-create')
	<div class="content-header-right">
		<a href="{{ route('package.create') }}" class="btn btn-primary btn-sm">Add Package</a>
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
							<input type="text" id="search" class="form-control" placeholder="Search by Title">
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
									<th width="30">SL</th>
									<th>Package For</th> 
									<th>Title</th>
									<th>Period</th>
									<th>Price</th>
									<th>Description</th>
									<th>Created by</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($models as $key=>$model)
								<tr id="id-{{ $model->id }}">
									<td>{{ $models->firstItem()+$key }}.</td>
									<td>
										@if ($model->package_for == 1)
											<span class="label label-member">Member</span>
										@elseif ($model->package_for == 2)
											<span class="label label-epc">EPC Developer</span> 
										@else
											N/A
										@endif
									</td> 
									<td>{!! \Illuminate\Support\Str::limit($model->title,40) !!}</td>
									<td>{{$model->period}}</td>
									<td>${!! \Illuminate\Support\Str::limit($model->price ?? '0.00', 50) !!}</td>
									<td>{!! \Illuminate\Support\Str::limit($model->description, 70) !!}</td>
									<td>{{isset($model->hasCreatedBy)?$model->hasCreatedBy->name:'N/A'}}</td>
									<td>
										@if($model->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td>
										@can('package-edit')
										<a href="{{route('package.edit', $model->id)}}" data-toggle="tooltip" data-placement="top" title="Edit model" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('package-delete')
										<button class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}" data-del-url="{{ url('package', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="10">
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