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

<section class="content-header">
	<div class="content-header-left">
		<h1>{{$page_title}}</h1>
	</div>
	@can('jobpost-list')
	<div class="content-header-right">
		<a href="{{ route('jobpost.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
	@endcan
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('jobpost.update', $jobposts->id)}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Job Post Category <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select name="category_id" id="category_id" class="form-control" required>
									<option value="" selected>Select Category</option>
									@foreach ($categories as $category)
										<option value="{{ $category->id }}" {{ $jobposts->job_category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
									@endforeach
								</select>
								<span style="color: red">{{ $errors->first('category_id') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Project<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="name" value="{{$jobposts->name}}" placeholder="Job Title">
								<span style="color: red">{{ $errors->first('name') }}</span>
							</div>
						</div>
						<div class="form-group">
                            <label for="county" class="col-sm-2 control-label">Alliance Area<span style="color: red">*</span></label>
                            <div class="col-sm-8">
                                <select name="county" id="county" class="form-control" required>
                                    <option value="" selected>Select County</option>
                                    @foreach(collect(['Amelia', 'Nottoway', 'Goochland', 'Halifax', 'Charlotte', 'Pittsylvania', 'Stafford', 'Spotsylvania', 'Powhatan', 'Fluvanna', 'Henry', 'Franklin', 'Greensville', 'Mecklenburg', 'Lunenburg', 'Prince Edward', 'Chesterfield', 'Dinwiddie', 'Brunswick', 'Appomattox', 'Campbell', 'Cumberland', 'Fairfax'])->sort() as $county)
                                        <option value="{{ $county }}" {{ old('county', $jobposts->county) == $county ? 'selected' : '' }}>{{ $county }}</option>
                                    @endforeach
                                </select>
                                <span style="color: red">{{ $errors->first('county') }}</span>
                            </div>
                        </div>
						{{-- <div class="form-group">
							<label for="" class="col-sm-2 control-label">Short Description<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="short_description" id="short_description" maxlength="200" style="height:140px;" placeholder="Enter Short Description">{{$jobposts->short_description}}</textarea>
								<span style="color: red">{{ $errors->first('short_description') }}</span>
							</div>
						</div> --}}
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control texteditor" name="description" id="description" maxlength="200" style="height:140px;" placeholder="Enter Description">{{$jobposts->description}}</textarea>
								<span style="color: red">{{ $errors->first('description') }}</span>
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Image<span style="color: red">*</span></label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" class="form-control" accept="image*" name="image" id="image">
							</div>
							<div class="col-sm-4">
								<img style="width: 80px" id="jobpost_preview" src="{{asset('/admin/assets/images/jobpost') }}/{{ $jobposts->image }}" alt="Image Not Found ">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-9">
								<select name="status" class="form-control" id="">
									<option value="1" {{ $jobposts->status==1?'selected':'' }}>Active</option>
									<option value="0" {{ $jobposts->status==0?'selected':'' }}>In-Active</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left">Post</button>
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
				jobpost_preview.src = URL.createObjectURL(file)
			}
		}
	});
</script>
@endpush