@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('testimonial.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('testimonial.update', $testimonial->slug) }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Name <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="name" value="{{$testimonial->name}}">
							</div>
						</div>
						{{-- <div class="form-group">
							<label for="" class="col-sm-2 control-label">Designation <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="designation" value="{{$testimonial->designation}}">
							</div>
						</div> --}} 
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Rating <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<div class="star-rating">
									<input type="hidden" name="rating" id="selected-rating" value="{{ $testimonial->rating }}">
									<div class="rating-stars">
										@for($i = 1; $i <= 5; $i++)
											<i class="far fa-star star-btn" data-rating="{{ $i }}"></i>
										@endfor
									</div>
								</div>
								<span style="color: red">{{ $errors->first('rating') }}</span>
							</div>
						</div> 

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Image <span style="color:red">*</span></label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" name="image" accept="image" id="image" class="form-control">
							</div>
							<div class="col-sm-4">
								<img style="width: 80px" id="banner_preview" src="{{asset('/admin/assets/images/testimonials') }}/{{ $testimonial->image }}" alt="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Comment <span style="color:red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control texteditor" name="comment" style="height:200px;">{{$testimonial->comment}}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-9">
								<select name="status" class="form-control" id="">
									<option value="1" {{ $testimonial->status==1?'selected':'' }}>Active</option>
									<option value="0" {{ $testimonial->status==0?'selected':'' }}>In-Active</option>
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

		$("#regform").validate({
			rules: {
				name: "required",
				comment: "required",
			}
		});
		image.onchange = evt => {
			const [file] = image.files
			if (file) {
				banner_preview.src = URL.createObjectURL(file)
			}
		}

		// Initialize stars with the existing rating
		const existingRating = {{ $testimonial->rating }};
		updateStars(existingRating);

		$('.star-btn').on('click', function() {
			const rating = $(this).data('rating');
			$('#selected-rating').val(rating);
			updateStars(rating);
		});

		$('.star-btn').on('mouseenter', function() {
			const rating = $(this).data('rating');
			previewStars(rating);
		});

		$('.rating-stars').on('mouseleave', function() {
			const currentRating = $('#selected-rating').val();
			updateStars(currentRating);
		});

		function updateStars(rating) {
			$('.star-btn').each(function() {
				const starRating = $(this).data('rating');
				if (starRating <= rating) {
					$(this).removeClass('far').addClass('fas active');
				} else {
					$(this).removeClass('fas active').addClass('far');
				}
			});
		}

		function previewStars(rating) {
			$('.star-btn').each(function() {
				const starRating = $(this).data('rating');
				if (starRating <= rating) {
					$(this).removeClass('far').addClass('fas');
				} else {
					$(this).removeClass('fas').addClass('far');
				}
			});
		}
	});
</script>
@endpush

@push('css')
<style>
    .star-rating .rating-stars {
        display: inline-flex;
        gap: 5px;
        cursor: pointer;
    }
    .star-rating .star-btn {
        font-size: 24px;
        color: #ccc;
        transition: color 0.2s;
    }
    .star-rating .star-btn.active {
        color: #ffc107;
    }
    .star-rating .star-btn:hover {
        color: #ffd700;
    }
</style>
@endpush
