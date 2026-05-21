@foreach($trainers as $key => $trainer)
    <tr id="trainer-row-{{ $trainer->id }}">
        <td>{{ $trainers->firstItem() + $key }}</td>
        <td>
            <div style="display:flex;align-items:center;gap:10px;">
                @if($trainer->image)
                    <img src="{{ asset('/admin/assets/images/UserImage/'.$trainer->image) }}" alt="" style="width:44px;height:44px;border-radius:8px;object-fit:cover;">
                @else
                    <img src="{{ asset('/admin/assets/images/default.jpg') }}" alt="" style="width:44px;height:44px;border-radius:8px;object-fit:cover;">
                @endif
                <div>
                    <strong>{{ $trainer->name ?: '—' }}</strong>
                    @if($trainer->designation)
                        <div style="font-size:12px;color:#6c7a88;">{{ $trainer->designation }}</div>
                    @endif
                </div>
            </div>
        </td>
        <td><span class="admin-truncate" title="{{ $trainer->trainer_type_display }}">{{ $trainer->trainer_type_display ?: '—' }}</span></td>
        <td>{{ $trainer->price ? '$'.$trainer->price : '—' }}</td>
        <td>
            @for($i = 1; $i <= 5; $i++)
                @if($i <= (int) $trainer->rating)
                    <i class="fas fa-star text-warning" style="font-size:12px;"></i>
                @else
                    <i class="far fa-star" style="font-size:12px;color:#ccc;"></i>
                @endif
            @endfor
        </td>
        <td>
            @if($trainer->status)
                <span class="admin-badge admin-badge--success">Active</span>
            @else
                <span class="admin-badge admin-badge--danger">Inactive</span>
            @endif
        </td>
        <td>{{ $trainer->hasCreatedBy->name ?? 'N/A' }}</td>
        <td>
            <div class="admin-actions">
                @can('trainer-edit')
                    <a href="{{ route('trainer.edit', $trainer->id) }}" class="btn btn-xs btn-admin-primary" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan
                @can('trainer-delete')
                    <button type="button" class="btn btn-xs btn-danger btn-admin-danger delete"
                        data-row-id="trainer-row-{{ $trainer->id }}"
                        data-del-url="{{ url('trainer/'.$trainer->id) }}"
                        title="Delete trainer">
                        <i class="fa fa-trash"></i>
                    </button>
                @endcan
            </div>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="8">
        Showing {{ $trainers->firstItem() }} to {{ $trainers->lastItem() }} of {{ $trainers->total() }} records
        <div class="text-center">{!! $trainers->links('pagination::bootstrap-4') !!}</div>
    </td>
</tr>
