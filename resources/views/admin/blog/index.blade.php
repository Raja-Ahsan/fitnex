@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('blog.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	@can('blog-create')
	<div class="content-header-right">
		<a href="{{ route('blog.create') }}" class="btn btn-primary btn-sm">Add blog</a>
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
									<th>SL</th>
									<th>Title</th>
									<th>Category</th> 
									<th>Created by</th>
									<th>Status</th>
									<th>Created At</th>
									<th width="140">Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@if($models->count() > 0)
									@foreach($models as $key=>$blog)
									<tr id="id-{{ $blog->id }}">
										<td>{{ $models->firstItem()+$key }}.</td>
										<td>{!! \Illuminate\Support\Str::limit($blog->title,40) !!}</td>
										<td>{{ isset($blog->hasCategory) ? $blog->hasCategory->name : 'N/A' }}</td> 
										<td>{{ isset($blog->hasCreatedBy) ? $blog->hasCreatedBy->name: 'N/A' }}</td> 
										<td>
											@if($blog->status)
											<span class="label label-success">Published</span>
											@else
											<span class="label label-warning">Draft</span>
											@endif
										</td>
										<td>{{ $blog->created_at->format('d-M-Y') }}</td>
										<td width="250px">
											<a href="{{route('blog.show', $blog->id)}}" data-toggle="tooltip" data-placement="top" title="Show blog" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a>
											@can('blog-edit')
											<a href="{{route('blog.edit', $blog->id)}}" data-toggle="tooltip" data-placement="top" title="Edit blog" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
											@endcan
											@can('blog-delete')
											<button class="btn btn-danger btn-xs delete" data-slug="{{ $blog->id }}" data-del-url="{{ url('blog', $blog->id) }}"><i class="fa fa-trash"></i> Delete</button>
											@endcan
										</td>
									</tr>
									@endforeach
								@else
									<tr>
										<td colspan="7" class="text-center">
											<div style="padding: 40px 20px;">
												<i class="fa fa-info-circle" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
												<h3 style="color: #666; margin-bottom: 10px;">No Blogs Found</h3>
												<p style="color: #999;">There are no blogs available at the moment.</p>
												@can('blog-create')
												<a href="{{ route('blog.create') }}" class="btn btn-primary btn-sm" style="margin-top: 15px;">
													<i class="fa fa-plus"></i> Add Your First Blog
												</a>
												@endcan
											</div>
										</td>
									</tr>
								@endif
								@if($models->count() > 0)
									<tr>
										<td colspan="7">
											Displying {{$models->firstItem()}} to {{$models->lastItem()}} of {{$models->total()}} records
											<div class="d-flex justify-content-center">
												{!! $models->links('pagination::bootstrap-4') !!}
											</div>
										</td>
									</tr>
								@endif
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