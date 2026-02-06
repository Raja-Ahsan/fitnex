@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('blog_category.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	@can('blog_category-create')
	<div class="content-header-right">
		<a href="{{ route('blog_category.create') }}" class="btn btn-primary btn-sm">Add Blog Category</a>
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
						<div class="d-flex col-sm-8">
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
									<th>No.</th> 
									<th>Blog Category</th> 
									<th>Status</th> 
									<th width="140">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($models as $key=>$model)
								<tr id="id-{{ $model->id }}">
									<td>{{ $models->firstItem()+$key }}.</td>
									<td>{{\Illuminate\Support\Str::limit($model->name,40)}}</td>
									<td>
										@if($model->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td width="250px">
										@can('blog_category-edit')
										<a href="{{route('blog_category.edit', $model->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Blog Category" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('blog_category-delete')
										<button class="btn btn-danger btn-xs delete" data-id="{{ $model->id }}" data-del-url="{{ url('blog_category', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
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