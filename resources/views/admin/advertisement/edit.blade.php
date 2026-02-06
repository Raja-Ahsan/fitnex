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
			<form action="{{route('advertisement.update', $advertisements->id)}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Name<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="name" value="{{$advertisements->name}}" placeholder="Enter Name">
								<span style="color: red">{{ $errors->first('name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Short Description<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="short_description" id="short_description" maxlength="200" style="height:140px;" placeholder="Enter Short Description">{{$advertisements->short_description}}</textarea>
								<span style="color: red">{{ $errors->first('short_description') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control texteditor" name="description" id="description" maxlength="200" style="height:140px;" placeholder="Enter Description">{{$advertisements->description}}</textarea>
								<span style="color: red">{{ $errors->first('description') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">State<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<select name="city_id" id="city_id" class="form-control">
									<option value="" selected>Select state</option>
									@foreach ($cities as $city)
									<option value="{{ $city->id }}" {{ $advertisements->city_id==$city->id?'selected':'' }}>{{ $city->city }}</option>
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
									@foreach ($states as $state)
									<option value="{{ $state->id }}" {{ $advertisements->state_id==$state->id?'selected':'' }}>{{ $state->state }}</option>
									@endforeach
								</select>
								<span style="color: red">{{ $errors->first('state_id') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Image<span style="color: red">*</span></label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" class="form-control" accept="image*" name="image" id="image">
							</div>
							<div class="col-sm-4">
								<img style="width: 80px" id="advertisement_preview" src="{{asset('/admin/assets/images/advertisement') }}/{{ $advertisements->image }}" alt="Image Not Found ">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-9">
								<select name="status" class="form-control" id="">
									<option value="1" {{ $advertisements->status==1?'selected':'' }}>Active</option>
									<option value="0" {{ $advertisements->status==0?'selected':'' }}>In-Active</option>
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
				/* 	title: "required"
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