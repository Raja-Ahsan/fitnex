@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.contractor.app')))
@section('title', $page_title)
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Category</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('project_category.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('project_category.update', $model->slug) }}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="box box-info">
					<div class="box-body">
                        {{-- <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Parent Category</label>
                            <div class="col-md-8">
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="" selected>No Parent</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}" {{ $model->parent_id == $category->slug ? 'selected':'' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                <span style="color: red">{{ $errors->first('parent_id') }}</span>
                            </div>
						</div> --}}
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title <span style="color:red">*</span></label>
							<div class="col-sm-8">
								<input type="text" autocomplete="off" class="form-control" name="title" value="{{$model->title}}">
							</div>
						</div>
						{{-- <div class="form-group">
							<label for="" class="col-sm-2 control-label">Description</label>
							<div class="col-sm-8">
							<textarea class="form-control" name="description" style="height:140px;">{!! $model->description !!}</textarea>
							</div>
						</div> --}}
						{{-- <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" class="form-control" accept="image*" name="image" id="image" >
                            </div>
                            @if(!empty($model->image))
                                <div class="col-sm-4">
                                    <img style="width: 80px" src="{{asset('/admin/assets/images/project_category') }}/{{ $model->image }}" alt="">
                                </div>
                            @else
                                <div class="col-sm-4" >
                                    <img style="width: 80px" id="banner_preview"  src="{{asset('/admin/assets/images/default.jpg') }}"  alt="Image Not Found ">
                                </div>
                            @endif
                        </div> --}}
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-8">
								<select name="status" class="form-control" id="">
									<option value="1" {{ $model->status==1?'selected':'' }}>Active</option>
									<option value="0" {{ $model->status==0?'selected':'' }}>In-Active</option>
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
        image.onchange = evt => {
			const [file] = image.files
			if (file) {
				banner_preview.src = URL.createObjectURL(file)
			}
		}
	});
</script>
@endpush
