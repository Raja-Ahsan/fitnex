@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<section class="content-header">
	<div class="content-header-left">
		<h1>Add Our Agents</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('agents.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('agents.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Name<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name">
								<span style="color: red">{{ $errors->first('name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Designation<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="designation" value="{{ old('designation') }}" placeholder="Enter designation">
								<span style="color: red">{{ $errors->first('designation') }}</span>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Facebook Link</label>
							<div class="col-sm-9">
								<input type="text"  autocomplete="off" class="form-control" name="facebook" value="{{ old('facebook') }}" placeholder="Enter facebook">
								<span style="color: red">{{ $errors->first('facebook') }}</span>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Twitter Link</label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="twitter" value="{{ old('twitter') }}" placeholder="Enter twitter">
								<span style="color: red">{{ $errors->first('twitter') }}</span>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Instagram</label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="instagram" value="{{ old('instagram') }}" placeholder="Enter instagram">
								<span style="color: red">{{ $errors->first('instagram') }}</span>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Behance Link</label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="behance" value="{{ old('behance') }}" placeholder="Enter behance">
								<span style="color: red">{{ $errors->first('behance') }}</span>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Youtube Link</label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="youtube" value="{{ old('youtube') }}" placeholder="Enter youtube">
								<span style="color: red">{{ $errors->first('youtube') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Image<span style="color: red">*</span></label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" name="image" class="form-control" accept="image" id="image">
								<span style="color: red">{{ $errors->first('image') }}</span>
							</div>
							<div class="col-sm-4">
								<img style="width: 80px" id="banner_preview"  src="{{asset('/admin/assets/images/default.jpg') }}"  alt="Image Not Found ">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-9">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
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
		$("#regform").validate({
			rules: {
				image: "required",
				name: "required",
				designation: "required",
			}
		});
		image.onchange = evt => {
		const [file] = image.files
		if (file) {
			banner_preview.src = URL.createObjectURL(file)
		}
		}
	});
</script>
@endpush
