@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.contractor.app')))
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>Show Project Category Details</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('project_category.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table bordered">
					<tr>
						<th>Image</th>
						<td>
							@if($project_category->image)
								<img src="{{ asset('/admin/assets/images/project_category') }}/{{ $project_category->image }}" alt="Slider Image" height="400px" width="500px">
							@else 
								<img src="{{ asset('/admin/assets/images/project_category/no-photo1.jpg') }}" alt="Slider Image" height="400px" width="500px">
							@endif
						</td>
					</tr>
					<tr>
						<th>Name</th>
						<td><span class="badge badge-success">{{ $project_category->name }}</span></td>
					</tr>
					<tr>
						<th>Short Description</th>
						<td>{!! $project_category->short_description !!}</td>
					</tr>
					<tr>
						<th>Full Description</th>
						<td>{!! $project_category->description !!}</td>
					</tr>
					<tr>
						<th>Status</th>
						<td>
							@if($project_category->status)
								<span class="badge badge-success">Active</span>
							@else 
								<span class="badge badge-danger">In-Active</span>
							@endif
						</td>
					</tr>
					<tr>
						<th>Date</th>
						<td>
							<span class="badge badge-success">{{ date('d, F-Y H:i:s A', strtotime($project_category->created_at)) }}</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('.editor_short').summernote({
			height: 150
		});
	});
</script>
@endsection