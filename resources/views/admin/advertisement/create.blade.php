@extends(((Auth::user()->hasRole('Admin')) ? 'layouts.admin.app' : 'layouts.contractor.app'))
@section('title', $page_title)
@section('content')
<section class="content-header">
	<div class="content-header-left">
		<h1>{{$page_title}}</h1>
	</div>
	@can('advertisement-list')
	<div class="content-header-right">
		<a href="{{ route('advertisement.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
	@endcan
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('advertisement.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
							<label for="" class="col-sm-2 control-label">Short Description<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="short_description" id="short_description" maxlength="200" style="height:140px;" placeholder="Enter Short Description"></textarea>
								<span style="color: red">{{ $errors->first('short_description') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control texteditor" name="description" id="description" maxlength="200" style="height:140px;" placeholder="Enter Description"></textarea>
								<span style="color: red">{{ $errors->first('description') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">State<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<select name="city_id" id="city_id" class="form-control">
									<option value="" selected>Select state</option>
									@foreach ($cities as $city)
									<option value="{{ $city->id }}" {{ old('city_id')==$city->id?'selected':'' }}>{{ $city->city }}</option>
									@endforeach
								</select>
								<span style="color: red">{{ $errors->first('city_id') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">City<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<select name="state_id" id="state_id" class="form-control">
									<option value="" selected>Select city</option>
								</select>
								<span style="color: red">{{ $errors->first('state_id') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Image <span style="color: red">*</span></label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" class="form-control" accept="image*" name="image" id="image">
								<span style="color: red">{{ $errors->first('image') }}</span>
							</div>
							<div class="col-sm-4">
								<img style="width: 80px" id="advertisement_preview" src="{{asset('/admin/assets/images/default.jpg') }}" alt="Image Not Found ">
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
	$(document).on('change', '#city_id', function() {
		var city_id = $(this).val();
		$.ajax({
			url: "{{ route('get_states') }}",
			data: {
				'city_id': city_id
			},
			type: 'GET',
			success: function(response) {
				var html = '';
				$.each(response, function(item, val) {
					html += '<option value="' + val.id + '">' + val.state + '</option>';
				});
				$('#state_id').html(html);

			}
		});
	});

	$(document).ready(function() {
		tinymce.init({
			selector: "textarea.texteditor",
			theme: "modern",
			height: 150,
			plugins: [
				"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
				"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				"save table contextmenu directionality emoticons template paste textcolor"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

		});

		$("#regform").validate({
			rules: {
				/* title: "required"
                description: "required" */
			}
		});
		image.onchange = evt => {
			const [file] = image.files
			if (file) {
				advertisement_preview.src = URL.createObjectURL(file)
			}
		}
	});
</script>
@endpush