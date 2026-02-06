@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('blog.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('blog.update', $model->id) }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="box-body">
						<div class="form-group">
							<label for="category_slug" class="col-sm-2 control-label">Category <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-control" name="category_slug">
									<option value="">Select Category</option>
									@foreach ($categories as $category)
										<option value="{{ $category->slug }}" {{ $model->category_slug == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
									@endforeach
								</select>
								<span style="color: red">{{ $errors->first('category_slug') }}</span>
							</div>
						</div>
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title <span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="title" value="{{ $model->title }}" placeholder="Enter blog title">
                                <span style="color: red">{{ $errors->first('title') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control texteditor" name="description" placeholder="Enter description">{{ $model->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" class="form-control" accept="image*" name="post" id="post" >
                            </div>
                            @if(!empty($model->post))
                                <div class="col-sm-4">
                                    <img style="width: 80px" src="{{asset('/admin/assets/posts') }}/{{ $model->post }}" alt="">
                                </div>
                            @else
                                <div class="col-sm-4" >
                                    <img style="width: 80px" id="banner_preview"  src="{{asset('/admin/assets/images/default.jpg') }}"  alt="Image Not Found ">
                                </div>
                            @endif
                        </div>
						<div class="form-group">
							<label for="status" class="col-sm-2 control-label">Status <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<select class="form-control" name="status">
									<option value="1" {{ $model->status == 1 ? 'selected' : '' }}>Published</option>
									<option value="0" {{ $model->status == 0 ? 'selected' : '' }}>Draft</option>
								</select>
								<span style="color: red">{{ $errors->first('status') }}</span>
							</div>
						</div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script>
	$(document).ready(function() {
		$("#regform").validate({
			rules: {
				title: "required"
			}
		});
	});
</script>
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
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

			});
		}
        image.onchange = evt => {
			const [file] = image.files
			if (file) {
				banner_preview.src = URL.createObjectURL(file)
			}
		}

	});
</script>
@endpush
