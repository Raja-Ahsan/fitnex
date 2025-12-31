@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('about.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>All About Us</h1>
	</div>
	@can('about-create')
	<!-- <div class="content-header-right">
		<a href="{{ route('about.create') }}" class="btn btn-primary btn-sm">Add About Us</a>
	</div> -->
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
						<div class="d-flex col-sm-10" style="margin-bottom: 10px;">
							<input type="text" id="search" class="form-control" placeholder="Search">
						</div>
						<div class="d-flex col-sm-5">
							<select name="" id="status" class="form-control status" style="margin-bottom:5px; display: none;">
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
									<th>Heading</th>
									<th>Short Description</th>
									<th>Description</th>
									<th>Status</th>
									<th>Created by</th>
									<th width="140">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($abouts as $key=>$about)
								<tr id="id-{{ $about->slug }}">
									<td>{{ $abouts->firstItem()+$key }}.</td>
									<td>
										@if($about->image)
											<img src="{{ asset('/admin/assets/images/about/'.$about->image) }}" alt="" style="width:60px;">
									@else
									<img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
									@endif
									</td>
									<td>{{($about->heading)}}</td>
									<td>{{\Illuminate\Support\Str::limit($about->short_description,60)}}</td>
									<td>{!! \Illuminate\Support\Str::limit($about->description,60) !!}</td>
									<td>
										@if($about->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td>{{isset($about->hasCreatedBy)?$about->hasCreatedBy->name:'N/A'}}</td>
									<td width="250px">
										@can('about-edit')
										<a href="{{route('about.edit', $about->id)}}" data-toggle="tooltip" data-placement="top" title="Edit About" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										<!-- @can('about-delete')
										<button class="btn btn-danger btn-xs delete" data-slug="{{ $about->slug }}" data-del-url="{{ url('about', $about->slug) }}"><i class="fa fa-trash"></i> Delete</button>
									@endcan -->
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="7">
										<div class="d-flex justify-content-center">
											{!! $abouts->links('pagination::bootstrap-4') !!}
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