@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('admin.trainer_review.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			 

			<div class="box box-info">
				<div class="box-body">
					 
					<div class="row">
						<div class="col-sm-1">Search:</div>
						<div class="d-flex col-sm-6">
							<input type="text" id="search" class="form-control" placeholder="Search">
						</div>
						<div class="d-flex col-sm-5">
							<select name="" id="status" class="form-control status" style="margin-bottom:5px">
								<option value="All" selected>Search by status</option>
								<option value="pending">Pending</option>
								<option value="approved">Approved</option>
							</select>
						</div>
					</div>
					<div class="card-body table-responsive p-0">
						<table id="" class="table table-hover table-bordered">
							<thead>
								<tr>
									<th width="40">SL</th>
									<th>Trainer</th>
									<th>Reviewer</th>
									<th>Rating</th>
									<th>Comment</th>
									<th width="90">Status</th>
									<th width="100">Created At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="body">
								@if($reviews->count() > 0)
									@foreach($reviews as $key=>$review)
									<tr id="id-{{ $review->id }}">
										<td>{{ $reviews->firstItem()+$key }}.</td>
										<td>
											@if($review->trainer && $review->trainer->user)
												<a href="{{ route('trainer.detail', $review->trainer_id) }}" target="_blank">{{ $review->trainer->name }}</a>
											@else
												Trainer #{{ $review->trainer_id }}
											@endif
										</td>
										<td>{{ $review->reviewer_name }}<br><small class="text-muted">{{ $review->reviewer_email }}</small></td>
										<td>
											@for($i = 1; $i <= 5; $i++)
												@if($i <= $review->rating)
													<i class="fas fa-star text-warning"></i>
												@else
													<i class="far fa-star"></i>
												@endif
											@endfor
										</td>
										<td>{!! \Illuminate\Support\Str::limit($review->comment, 60) !!}</td>
										<td>
											@if($review->status == 1)
												<span class="label label-success">Approved</span>
											@else
												<span class="label label-warning">Pending</span>
											@endif
										</td>
										<td>{{ $review->created_at->format('d-M-Y') }}</td>
										<td width="280px">
											<div style="display: flex; flex-wrap: nowrap; gap: 5px; align-items: center;">
												<a href="{{ route('admin.trainer_review.show', $review->id) }}" data-toggle="tooltip" data-placement="top" title="View review" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a>
											@if($review->status == 0)
												<form action="{{ route('admin.trainer_review.approve', $review->id) }}" method="post" style="display: inline-block; margin: 0;">
													@csrf
													<button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Approve</button>
												</form>
												<form action="{{ route('admin.trainer_review.reject', $review->id) }}" method="post" class="form-confirm-reject" style="display: inline-block; margin: 0;" data-message="Remove this review?">
													@csrf
													<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Reject</button>
												</form>
											@else
												<form action="{{ route('admin.trainer_review.reject', $review->id) }}" method="post" class="form-confirm-reject" style="display: inline-block; margin: 0;" data-message="Remove this review from the site?">
													@csrf
													<button type="submit" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Remove</button>
												</form>
											@endif
											</div>
										</td>
									</tr>
									@endforeach
								@else
									<tr>
										<td colspan="8" class="text-center">
											<div style="padding: 40px 20px;">
												<i class="fa fa-info-circle" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
												<h3 style="color: #666; margin-bottom: 10px;">No Reviews Found</h3>
												<p style="color: #999;">There are no trainer reviews at the moment.</p>
											</div>
										</td>
									</tr>
								@endif
								@if($reviews->count() > 0)
									<tr>
										<td colspan="8">
											Displying {{$reviews->firstItem()}} to {{$reviews->lastItem()}} of {{$reviews->total()}} records
											<div class="d-flex justify-content-center">
												{!! $reviews->links('pagination::bootstrap-4') !!}
											</div>
										</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('js')
<script>
$(document).on('submit', '.form-confirm-reject', function(e) {
	e.preventDefault();
	var formEl = this;
	var message = $(formEl).attr('data-message') || 'Are you sure?';
	Swal.fire({
		title: 'Are you sure?',
		text: message,
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#3085d6',
		confirmButtonText: 'Yes, remove it'
	}).then(function(result) {
		if (result.isConfirmed) {
			formEl.submit();
		}
	});
});
</script>
@endpush
