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
<tr>
    <td colspan="8">
        Displying {{$reviews->firstItem()}} to {{$reviews->lastItem()}} of {{$reviews->total()}} records
        <div class="d-flex justify-content-center">
            {!! $reviews->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
