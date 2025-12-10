@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.contractor.app')))
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('project_category.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>All Project Categories</h1>
	</div>
	@can('project_category-create')
	<div class="content-header-right">
		<a href="{{ route('project_category.create') }}" class="btn btn-primary btn-sm">Add Category</a>
	</div>
	@endcan
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body">
					<div class="row" style="margin-bottom: 10px;">
						<!-- {{-- <div class="col-sm-1">Search:</div> --}} -->
						<div class="d-flex col-sm-12">
							<input type="text" id="search" class="form-control" placeholder="Search by Title">
						</div>
						<div class="d-flex col-sm-4" style="display: none;">
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
									{{-- <th>Image</th> --}}
									<th>Title</th>
									{{-- <th>Categories</th> --}}
									<!-- <th>Description</th> -->
									<th>Status</th>
									<th>Created by</th>
									<th width="140">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($models as $key=>$model)
								<tr id="id-{{ $model->slug }}">
									<td>{{ $models->firstItem()+$key }}.</td>
									{{-- <td>
										@if($model->image)
										<img src="{{ asset('/admin/assets/images/project_category/'.$model->image) }}" alt="" style="width:60px;">
										@else
										<img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
										@endif
									</td> --}}

									<td>{{\Illuminate\Support\Str::limit($model->title,40)}}</td>
									{{-- <td>
										@if($model->parent_id)
										<span class="label label-primary">{{\Illuminate\Support\Str::limit($model->parent_id,40)}}</span>
										@else
										<span class="badge badge-danger">Main Category</span>
										@endif
									</td> --}}
									{{-- <td>{{\Illuminate\Support\Str::limit($model->description,40)}}</td> --}}

									<td>
										@if($model->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td>{{isset($model->hasCreatedBy)?$model->hasCreatedBy->name:'N/A'}}</td>
									<td width="250px">
										@can('project_category-edit')
										<a href="{{route('project_category.edit', $model->slug)}}" data-toggle="tooltip" data-placement="top" title="Edit Service" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('project_category-delete')
											<button class="btn btn-danger btn-xs delete" data-slug="{{ $model->slug }}" data-del-url="{{ url('project_category', $model->slug) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="8">
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
