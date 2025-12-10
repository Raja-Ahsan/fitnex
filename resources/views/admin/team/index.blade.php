@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('meet_the_team.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	@can('meet_the_team-create')
	<div class="content-header-right">
		<a href="{{ route('meet_the_team.create') }}" class="btn btn-primary btn-sm">Add Team Member</a>
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
									<th>Name</th>
									<th>Designation</th> 
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($teams as $key=>$team)
								<tr id="id-{{ $team->id }}">
									<td>{{ $teams->firstItem()+$key }}.</td>
									<td>
										@if($team->image)
										<img src="{{ asset('/admin/assets/images/team/'.$team->image) }}" alt="" style="width:60px;">
										@else
										<img src="{{ asset('/admin/assets/images/team/no-photo1.jpg') }}" style="width:60px;">
										@endif
									</td>
									<td>{{ $team->name }}</td>
									<td>{{ $team->designation }}</td>
									<td>
										@if($team->status)
										<span class="label label-success">Active</span>
										@else
										<span class="label label-danger">In-Active</span>
										@endif
									</td>
									<td>
										@can('meet_the_team-edit')
										<a href="{{route('meet_the_team.edit', $team->id)}}" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('meet_the_team-delete')
										<button class="btn btn-danger btn-xs delete" data-slug="{{ $team->id }}" data-del-url="{{ url('meet_the_team', $team->id) }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="8">
										Displying {{$teams->firstItem()}} to {{$teams->lastItem()}} of {{$teams->total()}} records
										<div class="d-flex justify-content-center">
											{!! $teams->links('pagination::bootstrap-4') !!}
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