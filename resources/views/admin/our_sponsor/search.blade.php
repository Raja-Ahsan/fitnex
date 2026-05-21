@foreach($models as $key=>$model)
    <tr id="id-{{ $model->id }}">
        <td>{{ $models->firstItem()+$key }}.</td>
        <td>
            @if($model->image)
                <img src="{{ asset('/admin/assets/images/our_sponsor/'.$model->image) }}" alt="" style="width:60px;">
            @else
                <img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
            @endif
        </td>
        <td>{{\Illuminate\Support\Str::limit($model->title,60)}}</td>
        <td>
            @if($model->status)
                <span class="label label-success">Active</span>
            @else
                <span class="label label-danger">In-Active</span>
            @endif
        </td>
        <td>{{isset($model->hasCreatedBy)?$model->hasCreatedBy->name:'N/A'}}</td>
        <td width="250px">
            @can('our_sponsor-edit')
                <a href="{{route('our_sponsor.edit', $model->id)}}" data-toggle="tooltip" data-placement="top" title="Edit our_sponsor" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
            @endcan
            @can('our_sponsor-delete')
                <button class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}" data-del-url="{{ url('our_sponsor', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
            @endcan
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="6">
        <div class="d-flex justify-content-center">
            {!! $models->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
