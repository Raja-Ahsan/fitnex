@extends('layouts.admin.app')
<title>Home About Us</title>
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
						<h3 class="sec_title text-center">About Us Heading</h3>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-9">
								<input type="text" name="home_about_title" class="form-control" value="{{ isset($page_data['home_about_title'])?$page_data['home_about_title']:'' }}" placeholder="Enter Title">
							</div>
						</div> 
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea name="home_about_description" class="form-control texteditor" cols="10" rows="5" placeholder="Enter Description">{!! isset($page_data['home_about_description'])?$page_data['home_about_description']:'' !!}</textarea>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">About Image</label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" class="form-control" accept="image*" id="home_image"  name="home_about_image" value="{!! isset($page_data['home_about_image'])?$page_data['home_about_image']:'' !!}">
                                <span style="color: red">{{ $errors->first('home_about_image') }}</span>
                            </div>
							<div class="col-sm-4" >
								<img style="width: 80px" id="banner_preview" src="{{ asset('/admin/assets/images/page/'.$page_data['home_about_image']) }}" alt="Image Not Found ">
							</div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home Page? </label>
                            <div class="col-sm-2">
                                <select name="about_status" class="form-control select2 select2-accessible" style="width:auto;" tabindex="-1" aria-hidden="true">
                                    <option value="1" {{ (isset($page_data['about_status'])?($page_data['about_status']==1?'selected':''):'') }}>Show</option>
                                    <option value="0" {{ (isset($page_data['about_status'])?($page_data['about_status']==0?'selected':''):'') }}>Hide</option>
                                </select>
                            </div>
                        </div>
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


		home_image.onchange = evt => {
			const [file] = home_image.files
			if (file) {
				banner_preview.src = URL.createObjectURL(file)
			}
		}
		
	});
</script>
@endpush
