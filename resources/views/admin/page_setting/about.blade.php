@extends('layouts.admin.app')
<title>About Us</title>
@section('content')
<section class="content-header">
	<div class="content-header-left">
		<h1>@if(!empty($model)) Edit @else Add @endif Page Setting of <strong>{{ $model->title }}</strong></h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('page.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('page_setting.store') }}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf

				<input type="hidden" name="parent_slug" id="" value="{{ $model->slug }}">
				<div class="box box-info">
					<div class="box-body"> 
						<h3 class="sec_title text-center">WHO WE ARE?</h3>

						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Short Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="about_description" style="height:60px;" placeholder="Enter address">{{ isset($page_data['about_description'])?$page_data['about_description']:'' }}</textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="about_description_two" style="height:100px;" placeholder="Enter address">{{ isset($page_data['about_description_two'])?$page_data['about_description_two']:'' }}</textarea>
							</div>
						</div>


						<div class="form-group">
							<label for="" class="col-sm-2 control-label">First Image</label>
							<div class="col-sm-6" style="padding-top:5px">
								<input
									type="file"
									class="form-control"
									name="about_us_image"
									id="about_us_image"
									accept="image/*">
								<span style="color: red">{{ $errors->first('about_us_image') }}</span>
							</div>
							<div class="col-sm-4">
								<img
									style="width: 80px;"
									id="about_banner_preview"
									src="{{ isset($page_data['about_us_image']) ? asset('/admin/assets/images/page/'.$page_data['about_us_image']) :asset('/admin/assets/images/default.jpg') }}"
									alt="Image Not Found">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="about_description_three" style="height:100px;" placeholder="Enter address">{{ isset($page_data['about_description_three'])?$page_data['about_description_three']:'' }}</textarea>
							</div>
						</div> 

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Second Image</label>
							<div class="col-sm-6" style="padding-top:5px">
								<input
									type="file"
									class="form-control"
									name="about_us_image2"
									id="about_us_image2"
									accept="image/*">
								<span style="color: red">{{ $errors->first('about_us_image2') }}</span>
							</div>
							<div class="col-sm-4">
								<img
									style="width: 80px;"
									id="about_banner_preview2"
									src="{{ isset($page_data['about_us_image2']) ? asset('/admin/assets/images/page/'.$page_data['about_us_image2']) :asset('/admin/assets/images/default.jpg') }}"
									alt="Image Not Found">
							</div>
						</div>

						<h3 class="sec_title text-center">OUR MISSION?</h3>

						
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Short Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="our_mission_description" style="height:60px;" placeholder="Enter description">{{ isset($page_data['our_mission_description'])?$page_data['our_mission_description']:'' }}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="first_description" style="height:60px;" placeholder="Enter description">{{ isset($page_data['first_description'])?$page_data['first_description']:'' }}</textarea>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">First Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="first_our_mission_description" {{-- style="height:40px;" --}} placeholder="Enter text here">{{ isset($page_data['first_our_mission_description'])?$page_data['first_our_mission_description']:'' }}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Second Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="second_our_mission_description" {{-- style="height:60px;" --}} placeholder="Enter text here">{{ isset($page_data['second_our_mission_description'])?$page_data['second_our_mission_description']:'' }}</textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Third Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="third_our_mission_description" {{-- style="height:60px;" --}} placeholder="Enter text here">{{ isset($page_data['third_our_mission_description'])?$page_data['third_our_mission_description']:'' }}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Fourth Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="fourth_our_mission_description" {{-- style="height:60px;" --}} placeholder="Enter text here">{{ isset($page_data['fourth_our_mission_description'])?$page_data['fourth_our_mission_description']:'' }}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">OUR Mission Image</label>
							<div class="col-sm-6" style="padding-top:5px">
								<input
									type="file"
									class="form-control"
									name="why_image"
									id="why_image"
									accept="image/*">
								<span style="color: red">{{ $errors->first('why_image') }}</span>
							</div>
							<div class="col-sm-4">
								<img
									style="width: 80px;"
									id="why_banner_preview"
									src="{{ isset($page_data['why_image']) ? asset('/admin/assets/images/page/'.$page_data['why_image']) :asset('/admin/assets/images/default.jpg') }}"
									alt="Image Not Found">
							</div>
						</div>
						<!--<div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on About Us Page? </label>
                            <div class="col-sm-2">
                                <select name="about_status" class="form-control select2 select2-accessible" style="width:auto;" tabindex="-1" aria-hidden="true">
                                    <option value="1" {{ (isset($page_data['about_status'])?($page_data['about_status']==1?'selected':''):'') }}>Show</option>
                                    <option value="0" {{ (isset($page_data['about_status'])?($page_data['about_status']==0?'selected':''):'') }}>Hide</option>
                                </select>
                            </div>
                        </div> -->
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form_about">Update</button>
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
		// Initialize TinyMCE for text editors
		if ($(".texteditor").length > 0) {
			tinymce.init({
				selector: "textarea.texteditor",
				theme: "modern",
				height: 150,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
			});
		}

		// Preview for About Image
		$('#about_us_image').on('change', function(evt) {
			const [file] = this.files;
			if (file) {
				$('#about_banner_preview').attr('src', URL.createObjectURL(file));
			}
		});

		$('#about_us_image2').on('change', function(evt) {
			const [file] = this.files;
			if (file) {
				$('#about_banner_preview2').attr('src', URL.createObjectURL(file));
			}
		});

		// Preview for Why Join Us Image
		$('#why_image').on('change', function(evt) {
			const [file] = this.files;
			if (file) {
				$('#why_banner_preview').attr('src', URL.createObjectURL(file));
			}
		});
		
	});
</script>
@endpush