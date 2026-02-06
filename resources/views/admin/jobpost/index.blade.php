@php
    if (Auth::user()->hasRole('Admin')) {
        $layout = 'layouts.admin.app';
    } elseif (Auth::user()->hasRole('EPC Developer')) {
        $layout = 'layouts.epc-developer.app';
    } elseif (Auth::user()->hasRole('Contractor')) {
        $layout = 'layouts.contractor.app';
    } else {
        $layout = 'layouts.member.app';
    }
@endphp

@extends($layout)
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('jobpost.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{$page_title}}</h1>
	</div>
	@can('jobpost-create')
	<div class="content-header-right">
		<a href="{{ route('jobpost.create') }}" class="btn btn-primary btn-sm">Add Job</a>
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
									<th>Job Title</th>
									<th>Job Category</th>
									<th>Alliance Area</th>
									<th>Short Description</th> 
									<th>Status</th>
									<th>Created by</th>
									<th width="140">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($jobposts as $key=>$jobpost)
								<tr id="id-{{ $jobpost->id }}">
									<td>{{ $jobposts->firstItem()+$key }}.</td>
									<td>
										@if($jobpost->image)
										<img src="{{ asset('/admin/assets/images/jobpost') }}/{{ $jobpost->image }}" style="width:60px;" alt="">
										@else
										<img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
										@endif
									</td>
									<td>{{ $jobpost->name }}</td>
									<td>{{ isset($jobpost->hasCategory) ? $jobpost->hasCategory->title : 'N/A' }}</td>
									<td>{!! \Illuminate\Support\Str::limit($jobpost->county ?? 'N/A', 50) !!}</td>
									<td>{!! \Illuminate\Support\Str::limit( $jobpost->short_description , 20) !!}</td>
									<td>
										@if($jobpost->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td>{{isset($jobpost->hasCreatedBy)?$jobpost->hasCreatedBy->name:'N/A'}}</td>
									<td width="250px">
										@can('jobpost-edit')
										<a href="{{route('jobpost.edit', $jobpost->id)}}" data-toggle="tooltip" data-placement="top" title="Edit jobpost" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('jobpost-delete')
										<button class="btn btn-danger btn-xs delete" data-slug="{{ $jobpost->id }}" data-del-url="{{ url('jobpost', $jobpost->id) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="9">
										<div class="d-flex justify-content-center">
											{!! $jobposts->links('pagination::bootstrap-4') !!}
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