@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<section class="content-header">
	<div class="content-header-left">
		<h1>{{$page_title}}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('trainer.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('trainer.update', $trainer->id) }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				{{ method_field('PATCH') }}
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Name<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="name" value="{{ old('name', $trainer->name) }}" placeholder="Enter Name" autocomplete="name">
								<span style="color: red">{{ $errors->first('name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Designation<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="on" class="form-control" name="designation" value="{{ old('designation', $trainer->designation) }}" placeholder="Enter Designation" autocomplete="organization-title">
								<span style="color: red">{{ $errors->first('designation') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Rating</label>
							<div class="col-sm-9">
								<div class="star-rating">
									<input type="hidden" name="rating" id="selected-rating" value="{{ old('rating', $trainer->rating) }}">
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
							<label for="" class="col-sm-2 control-label">Email<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="email" autocomplete="off" class="form-control" name="email" value="{{ old('email', $trainer->email) }}" placeholder="Enter Email" autocomplete="email">
								<span style="color: red">{{ $errors->first('email') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Phone<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="phone" autocomplete="off" class="form-control" name="phone" value="{{ old('phone', $trainer->phone) }}" placeholder="Enter Phone" autocomplete="tel">
								<span style="color: red">{{ $errors->first('phone') }}</span>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Description<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea name="description" autocomplete="off" class="form-control" placeholder="Enter description">{{ old('description', $trainer->description) }}</textarea>
								<span style="color: red">{{ $errors->first('description') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="specialization" class="col-sm-2 control-label">Specialization</label>
							<div class="col-sm-9">
								<div id="specialization_container">
									@php
										$specializations = old('specialization', json_decode($trainer->specialization, true) ?: []);
									@endphp
									@if (!empty($specializations))
										@foreach ($specializations as $spec)
											<div class="input-group specialization-item" style="margin-bottom: 10px;">
												<input type="text" autocomplete="off" class="form-control" name="specialization[]" value="{{ $spec }}" placeholder="Enter specialization">
												<span class="input-group-btn">
													<button class="btn btn-danger remove-specialization" type="button">Remove</button>
												</span>
											</div>
										@endforeach
									@else
										<div class="input-group specialization-item" style="margin-bottom: 10px;">
											<input type="text" autocomplete="off" class="form-control" name="specialization[]" placeholder="Enter specialization">
											<span class="input-group-btn">
												<button class="btn btn-danger remove-specialization" type="button">Remove</button>
											</span>
										</div>
									@endif
								</div>
								<span style="color: red">{{ $errors->first('specialization.*') }}</span>
								<button type="button" class="btn btn-info add-more-specialization" style="margin-top: 10px;">Add Specialization</button>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Trainer Type<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="trainer_type" value="{{ old('trainer_type', $trainer->trainer_type) }}" placeholder="Enter trainer type">
								<span style="color: red">{{ $errors->first('trainer_type') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">City</label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="city" value="{{ old('city', $trainer->city) }}" placeholder="Enter City">
								<span style="color: red">{{ $errors->first('city') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">State</label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="state" value="{{ old('state', $trainer->state) }}" placeholder="Enter State">
								<span style="color: red">{{ $errors->first('state') }}</span>
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Price<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="price" value="{{ old('price', $trainer->price) }}" placeholder="Enter price">
								<span style="color: red">{{ $errors->first('price') }}</span>
							</div>
						</div>

                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Twitter Link</label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="twitter" value="{{ old('twitter', $trainer->twitter) }}" placeholder="Enter twitter" autocomplete="url">
								<span style="color: red">{{ $errors->first('twitter') }}</span>
							</div>
						</div>
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Instagram Link</label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="instagram" value="{{ old('instagram', $trainer->instagram) }}" placeholder="Enter instagram" autocomplete="url">
								<span style="color: red">{{ $errors->first('instagram') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Image <span style="color: red">*</span></label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" class="form-control" accept="image*"  name="image" id="image">
                                <span style="color: red">{{ $errors->first('image') }}</span>
                            </div>
                            <div class="col-sm-4" >
                                <img style="width: 80px" id="banner_preview"  src="{{ $trainer->image ? asset('admin/assets/images/UserImage/'.$trainer->image) : asset('/admin/assets/images/default.jpg') }}"  alt="Image Not Found ">
                            </div>
                        </div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-9">
								<select name="status" class="form-control" id="">
									<option value="1" {{ $trainer->status==1?'selected':'' }}>Active</option>
									<option value="0" {{ $trainer->status==0?'selected':'' }}>In-Active</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-9">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<div id="specialization_template" style="display: none;">
    <div class="input-group specialization-item" style="margin-bottom: 10px;">
        <input type="text" class="form-control" name="specialization[]" placeholder="Enter specialization">
        <span class="input-group-btn">
            <button class="btn btn-danger remove-specialization" type="button">Remove</button>
        </span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateRemoveButtons() {
        const items = document.querySelectorAll('#specialization_container .specialization-item');
        items.forEach((item) => {
            const removeButton = item.querySelector('.remove-specialization');
            if (items.length > 1) {
                removeButton.style.visibility = 'visible';
            } else {
                removeButton.style.visibility = 'hidden';
            }
        });
    }

    document.querySelector('.add-more-specialization').addEventListener('click', function () {
        const template = document.getElementById('specialization_template').firstElementChild.cloneNode(true);
        document.getElementById('specialization_container').appendChild(template);
        updateRemoveButtons();
    });

    document.getElementById('specialization_container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-specialization')) {
            e.target.closest('.specialization-item').remove();
            updateRemoveButtons();
        }
    });

    // Initial check
    updateRemoveButtons();
});
</script>
@endsection
@push('js')
<script>
	$(document).ready(function() {
		$('.select2').select2();
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

		document.getElementById('image').onchange = function(evt) {
			const [file] = this.files;
			if (file) {
				document.getElementById('banner_preview').src = URL.createObjectURL(file);
			}
		}


		// Initialize stars based on old value if it exists
		const oldRating = {{ old('rating', $trainer->rating ?? 1) }};
		updateStars(oldRating);

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
