@foreach($models as $key=>$model)
<tr id="id-{{ $model->id }}">
    <td>{{ $models->firstItem()+$key }}.</td>
    <td>{{$model->project_id}}</td>
    <td>{{$model->name}}</td>
    <td>{{$model->email}}</td>
    <td>{{$model->phone}}</td>
    <td>{{$model->message}}</td>
    {{-- <td>
        @if($model->status)
        <span class="badge badge-success">Active</span>
        @else
        <span class="badge badge-danger">In-Active</span>
        @endif
    </td> --}}
    <td width="250px">
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}" data-del-url="{{ url('client_contact', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
    </td>
</tr>
@endforeach
<tr>
    <td colspan="7">
        <div class="d-flex justify-content-center">
            {!! $models->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
