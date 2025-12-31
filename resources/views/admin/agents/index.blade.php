@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('agents.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>Our Agents</h1>
	</div>
	@can('agents-create')
	<div class="content-header-right">
		<a href="{{ route('agents.create') }}" class="btn btn-primary btn-sm">Add Our Agents</a>
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
							<select name="status" id="status" class="form-control status" style="margin-bottom:5px">
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
									{{-- <th>Facebook</th>
								<th>Twitter</th>
								<th>Instagram</th> --}}
									{{-- <th>Behance</th> --}}
									{{-- <th>Youtube</th> --}}
									<th>Status</th>
									<th>Created by</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@foreach($agents as $key=>$agent)
								<tr id="id-{{ $agent->slug }}">
									<td>{{ $agents->firstItem()+$key }}.</td>
									<td>
										@if($agent->image)
										<img src="{{ asset('/admin/assets/images/Agents/'.$agent->image) }}" alt="" style="width:60px;">
										@else
										<img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}" style="width:60px;">
										@endif
									</td>
									<td>{{ $agent->name }}</td>
									<td>{{ $agent->designation }}</td>
									{{-- <td>{{ $agent->facebook }} </td>
									<td>{{ $agent->twitter }}</td>
									<td>{{ $agent->instagram }}</td> --}}
									{{-- <td>{{ $agent->behance }}</td> --}}
									{{-- <td>{{ $agent->youtube }}</td> --}}
									<td>
										@if($agent->status)
										<span class="badge badge-success">Active</span>
										@else
										<span class="badge badge-danger">In-Active</span>
										@endif
									</td>
									<td>{{isset($agent->hasCreatedBy)?$agent->hasCreatedBy->name:'N/A'}}</td>
									<td>
										@can('agents-edit')
										<a href="{{route('agents.edit', $agent->slug)}}" data-toggle="tooltip" data-placement="top" title="Edit Agents" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
										@endcan
										@can('agents-delete')
										<button class="btn btn-danger btn-xs delete" data-slug="{{ $agent->slug }}" data-del-url="{{ url('agents', $agent->slug) }}"><i class="fa fa-trash"></i> Delete</button>
										@endcan
									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="7">
										Displying {{$agents->firstItem()}} to {{$agents->lastItem()}} of {{$agents->total()}} records
										<div class="d-flex justify-content-center">
											{!! $agents->links('pagination::bootstrap-4') !!}
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