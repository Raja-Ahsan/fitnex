@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.contractor.app')))
@section('title', $page_title)
@section('content')
<style>
	/* Style the select element */  
	#package_for {
		color: #000;
		/* Normal option color */
	}

	/* Style the disabled option */
	#package_for option[disabled] {
		color: #aaa;
		/* Placeholder color */
		cursor: not-allowed;
		/* Change cursor to indicate disabled */
	}

	/* Ensure the disabled option does not interfere when hovered */
	#package_for option:hover {
		background-color: #fff;
		/* Remove background color on hover */
	}
</style>
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('package.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('package.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<div class="box box-info">
					<div class="box-body">
						
						<!-- Package For Dropdown -->
						<div class="form-group">
							<label for="package_for" class="col-sm-2 control-label">Package for</label>
							<div class="col-sm-9">
								<select class="form-control" name="package_for" id="package_for">
									<option value="" disabled selected>Choose one</option>
									<option value="1">Member</option>
									<option value="2">EPC Developer</option> 
								</select>
								<span style="color: red">{{ $errors->first('package_for') }}</span>
							</div>
						</div> 
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Title <span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" autocomplete="off" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter package title">
								<span style="color: red">{{ $errors->first('title') }}</span>
							</div>
						</div>

						<div class="form-group">
							<label for="period" class="col-sm-2 control-label">Period for</label>
							<div class="col-sm-9">
								<select class="form-control" name="period" id="period">
									<option value="" disabled selected>Choose one</option>
									<option value="Month">Month</option>
									<option value="3 Months">3 Months</option>
									<option value="6 Months">6 Months</option>
									<option value="Year">Year</option>
								</select>
								<span style="color: red">{{ $errors->first('period') }}</span>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Price</label>
							<div class="col-sm-9">
								<input type="number" autocomplete="off" class="form-control" name="price" value="{{ old('price') }}" placeholder="Enter package price">
								<span style="color: red">{{ $errors->first('price') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description <span style="color: red">*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control texteditor" name="description" style="height:200px;" placeholder="Enter description"></textarea>
								<span style="color: red">{{ $errors->first('description') }}</span>
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
				title: "required",
				description: "required",
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		// Handle the visibility of the "Select Game" field
		$('#package_for').on('change', function() {
			const selectedValue = $(this).val();
			if (selectedValue === "2") { // Participate Fee
				$('#select_game_wrapper').show();
			} else {
				$('#select_game_wrapper').hide();
				$('#game').val(''); // Reset the "Select Game" field
			}
		});
	});
</script>

@endpush