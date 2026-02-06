@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Join With Us</h1>
	</div>
	@can('newsletter-list')
	<div class="content-header-right">
		<a href="{{ route('newsletter.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
	@endcan
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('newsletter.update', $news_letters->id)}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="box box-info">
					<div class="box-body">
						<!-- <div class="form-group">
							<label for="" class="col-sm-2 control-label">Name <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="name" value="{{$news_letters->name}}">
							</div>
						</div> -->
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Email <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="email" autocomplete="off" class="form-control" name="email" value="{{$news_letters->email}}">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-9">
								<select name="status" class="form-control" id="">
									<option value="1" {{ $news_letters->status==1?'selected':'' }}>Active</option>
									<option value="0" {{ $news_letters->status==0?'selected':'' }}>In-Active</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

@endsection
@push('js')
<script>
	$(document).ready(function() {

		$("#regform").validate({
			rules: {
			/* 	title: "required"
                description: "required" */
			}
		});
	});


</script>
@endpush
