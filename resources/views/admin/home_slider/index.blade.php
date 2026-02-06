@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('homeslider.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>All Home Sliders</h1>
	</div>
	@can('homeslider-create')
	<div class="content-header-right">
		<a href="{{ route('homeslider.create') }}" class="btn btn-primary btn-sm">Add Home Slider</a>
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
									<th width="30">SL</th>
									<th>Image</th>
									<th>Title</th> 
									<th>Heading</th> 
									<th>Description</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($homesliders as $key=>$homeSlider)
								<tr id="id-{{ $homeSlider->id }}">
									<td>{{ $homesliders->firstItem()+$key }}.</td>
									<td>
										@if($homeSlider->image)
										<img src="{{ asset('/admin/assets/images/HomeSlider/'.$homeSlider->image) }}" alt="" style="width:60px;">
										@else
										<img src="{{ asset('/admin/assets/images/HomeSlider/no-photo1.jpg') }}" style="width:60px;">
										@endif
									</td>
									<td>{!! $homeSlider->title !!}</td>
									<td>{!! $homeSlider->heading !!}</td>
									<td>{!! \Illuminate\Support\Str::limit($homeSlider->description,60) !!}</td>
									<td>
										@if($homeSlider->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td>
										@can('homeslider-edit')
										<a href="{{route('homeslider.edit', $homeSlider->id)}}" data-toggle="tooltip" data-placement="top" title="Edit home slider" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('homeslider-delete')
										<button class="btn btn-danger btn-xs delete" data-slug="{{ $homeSlider->id }}" data-del-url="{{ url('homeslider', $homeSlider->id) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="7">
										Displying {{$homesliders->firstItem()}} to {{$homesliders->lastItem()}} of {{$homesliders->total()}} records
										<div class="d-flex justify-content-center">
											{!! $homesliders->links('pagination::bootstrap-4') !!}
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