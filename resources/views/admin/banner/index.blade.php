@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('banner.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{$page_title}}</h1>
	</div>
	@can('banner-create')
	<div class="content-header-right">
		<a href="{{ route('banner.create') }}" class="btn btn-primary btn-sm">Add Banner</a>
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
						<div class="d-flex col-sm-5">
							<input type="text" id="search" class="form-control" placeholder="Search">
						</div>
						<div class="d-flex col-sm-6">
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
									<th>Banner Title</th>
									<th>Page</th>
									<!-- <th>Short Description</th> -->
									<th>Status</th>
									<th width="140">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($banners as $key=>$banner)
								<tr id="id-{{ $banner->id }}">
									<td>{{ $banners->firstItem()+$key }}.</td>
									<td>
										@if($banner->image)
										<img src="{{ asset('/admin/assets/images/banner') }}/{{ $banner->image }}" style="width:60px;" alt="">
										@else
										<img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
										@endif
									</td>
									<td>{{ $banner->name }}</td>
									<td>{{ $pages[$banner->slug] ?? $banner->slug }}</td>
									<td>
										@if($banner->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td width="250px">
										@can('banner-edit')
										<a href="{{route('banner.edit', $banner->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Banner" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('banner-delete')
											<button class="btn btn-danger btn-xs delete" data-slug="{{ $banner->id }}" data-del-url="{{ url('banner', $banner->id) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="6">
										<div class="d-flex justify-content-center">
											{!! $banners->links('pagination::bootstrap-4') !!}
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