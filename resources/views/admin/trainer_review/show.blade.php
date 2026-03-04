@extends('layouts.admin.app')
@section('title', $page_title)

@push('css')
<style>
    .content-wrapper { background-color: #f4f6f9; }
    .review-detail-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-top: 20px;
        border: 1px solid #eee;
    }
    .review-detail-content { padding: 40px; }
    .review-detail-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }
    .review-detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    .review-detail-meta span { display: flex; align-items: center; }
    .review-detail-meta i { margin-right: 8px; color: #3c8dbc; }
    .review-detail-body { font-size: 16px; line-height: 1.8; color: #333; white-space: pre-wrap; }
    .review-rating { color: #f39c12; }
    .review-label { margin-left: 5px; }
</style>
@endpush

@section('content')
<section class="content-header">
    {{-- <div class="content-header-left">
        <h1>{{ $page_title }}</h1>
    </div> --}}
    <div class="content-header-right">
        <a href="{{ route('admin.trainer_review.index') }}" class="btn btn-primary btn-sm">Back to Reviews</a>
        @if($review->status == 0)
            <form action="{{ route('admin.trainer_review.approve', $review->id) }}" method="post" style="display: inline-block;">
                @csrf
                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</button>
            </form>
            <form action="{{ route('admin.trainer_review.reject', $review->id) }}" method="post" class="form-confirm-reject" style="display: inline-block;" data-message="Remove this review?">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</button>
            </form>
        @else
            <form action="{{ route('admin.trainer_review.reject', $review->id) }}" method="post" class="form-confirm-reject" style="display: inline-block;" data-message="Remove this review from the site?">
                @csrf
                <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash"></i> Remove</button>
            </form>
        @endif
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="review-detail-container">
                <div class="review-detail-content">
                    <h1 class="review-detail-title">Review by {{ $review->reviewer_name }}</h1>
                    <div class="review-detail-meta">
                        <span>
                            <i class="fa fa-envelope"></i>
                            {{ $review->reviewer_email }}
                        </span>
                        <span>
                            <span class="review-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= (int) $review->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </span>
                            {{ (int) $review->rating }}/5
                        </span>
                        <span>
                            <i class="fa fa-calendar"></i>
                            {{ $review->created_at->format('F d, Y \a\t H:i') }}
                        </span>
                        <span>
                            <i class="fa fa-info-circle"></i> Status:
                            @if($review->status == 1)
                                <span class="label label-success review-label">Approved</span>
                            @else
                                <span class="label label-warning review-label">Pending</span>
                            @endif
                        </span>
                        <span>
                            <i class="fa fa-user"></i> Trainer:
                            @if($review->trainer && $review->trainer->user)
                                <a href="{{ route('trainer.detail', $review->trainer_id) }}" target="_blank">{{ $review->trainer->name }}</a>
                            @else
                                Trainer #{{ $review->trainer_id }}
                            @endif
                        </span>
                    </div>

                    <h4 style="margin-bottom: 10px; color: #333;">Comment:</h4>
                    <div class="review-detail-body">{{ $review->comment ?: '—' }}</div>
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
        if (result.isConfirmed) { formEl.submit(); }
    });
});
</script>
@endpush
