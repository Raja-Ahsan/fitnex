@extends('layouts.admin.app')
<title>Careers</title>
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
						<h3 class="sec_title text-center">CAREERS</h3>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Heading</label>
							<div class="col-sm-9">
								<input type="text" name="careers_heading" class="form-control" value="{{ isset($page_data['careers_heading'])?$page_data['careers_heading']:'' }}" placeholder="Enter Heading">
							</div>
						</div>
						<h3 class="sec_title text-center">Job Summary:</h3>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-9">
								<input type="text" name="job_summary" class="form-control" value="{{ isset($page_data['job_summary'])?$page_data['job_summary']:'' }}" placeholder="Enter Job Summary">
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea name="job_description" class="form-control texteditor" cols="10" rows="5" placeholder="Enter Job Description">{!! isset($page_data['job_description'])?$page_data['job_description']:'' !!}</textarea>
							</div>
						</div>
						<h3 class="sec_title text-center">Job Functions:</h3>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-9">
								<input type="text" name="job_functions" class="form-control" value="{{ isset($page_data['job_functions'])?$page_data['job_functions']:'' }}" placeholder="Enter Job Functions">
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea name="job_functions_description" class="form-control texteditor" cols="10" rows="5" placeholder="Enter Job Functions Description">{!! isset($page_data['job_functions_description'])?$page_data['job_functions_description']:'' !!}</textarea>
							</div>
						</div>
                       
						<h3 class="sec_title text-center">Knowledge, Skills, and Abilities:</h3>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-9">
								<input type="text" name="knowledge_skills_heading" class="form-control" value="{{ isset($page_data['knowledge_skills_heading'])?$page_data['knowledge_skills_heading']:'' }}" placeholder="Enter Heading">
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea name="knowledge_skills_description" class="form-control texteditor" cols="10" rows="5" placeholder="Enter Description">{!! isset($page_data['knowledge_skills_description'])?$page_data['knowledge_skills_description']:'' !!}</textarea>
							</div>
						</div> 
						<h3 class="sec_title text-center">Experience and Education:</h3>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-9">
								<input type="text" name="experience_education_heading" class="form-control" value="{{ isset($page_data['experience_education_heading'])?$page_data['experience_education_heading']:'' }}" placeholder="Enter Heading">
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea name="experience_education_description" class="form-control texteditor" cols="10" rows="5" placeholder="Enter Description">{!! isset($page_data['experience_education_description'])?$page_data['experience_education_description']:'' !!}</textarea>
							</div>
						</div> 
						<h3 class="sec_title text-center">Compensation:</h3>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-9">
								<input type="text" name="compensation_heading" class="form-control" value="{{ isset($page_data['compensation_heading'])?$page_data['compensation_heading']:'' }}" placeholder="Enter Heading">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea name="compensation_description" class="form-control texteditor" cols="10" rows="5" placeholder="Enter Description">{!! isset($page_data['compensation_description'])?$page_data['compensation_description']:'' !!}</textarea>
							</div>
						</div>
						<h3 class="sec_title text-center">To Apply:</h3>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-9">
								<input type="text" name="to_apply_heading" class="form-control" value="{{ isset($page_data['to_apply_heading'])?$page_data['to_apply_heading']:'' }}" placeholder="Enter Heading">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-9">
								<textarea name="to_apply_description" class="form-control texteditor" cols="10" rows="5" placeholder="Enter Description">{!! isset($page_data['to_apply_description'])?$page_data['to_apply_description']:'' !!}</textarea>
							</div>
						</div>
						
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Careers Page?</label>
                            <div class="col-sm-2">
                                <select name="careers_status" class="form-control select2 select2-accessible" style="width:auto;" tabindex="-1" aria-hidden="true">
                                    <option value="1" {{ (isset($page_data['careers_status'])?($page_data['careers_status']==1?'selected':''):'') }}>Show</option>
                                    <option value="0" {{ (isset($page_data['careers_status'])?($page_data['careers_status']==0?'selected':''):'') }}>Hide</option>
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
		home_our_image.onchange = evt => {
			const [file] = home_our_image.files
			if (file) {
				our_preview.src = URL.createObjectURL(file)
			}
		}
	});
</script>
@endpush
