@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('event.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('event.update', $event->id ) }}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="title" value="{{$event->title}}">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Host <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="host" value="{{$event->host}}">
								<span style="color: red">{{ $errors->first('host') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Date <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="date" autocomplete="off" class="form-control" name="date" value="{{$event->date}}">
								<span style="color: red">{{ $errors->first('date') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Start Time <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="time" autocomplete="off" class="form-control" name="time" value="{{$event->time}}">
								<span style="color: red">{{ $errors->first('time') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">End Time <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="time" autocomplete="off" class="form-control" name="end_time" value="{{$event->end_time}}">
								<span style="color: red">{{ $errors->first('end_time') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Location <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="location" value="{{$event->location}}">
								<span style="color: red">{{ $errors->first('location') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Location Link <span style="color:red">*</span></label>
							<div class="col-sm-7">
								<input type="url" autocomplete="off" class="form-control" name="location_link" value="{{$event->location_link}}">
								<span style="color: red">{{ $errors->first('location_link') }}</span>
							</div>
							<div class="col-sm-3">
								<a href="https://www.google.com/maps" target="_blank" class="btn btn-primary">Get Location</a>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Registration Link <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="registration_link" value="{{$event->registration_link}}">
								<span style="color: red">{{ $errors->first('registration_link') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-9">
								<select name="status" class="form-control" id="">
									<option value="1" {{ $event->status==1?'selected':'' }}>Active</option>
									<option value="0" {{ $event->status==0?'selected':'' }}>In-Active</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
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
	});
</script>
@endpush
