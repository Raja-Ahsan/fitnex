@foreach($models as $key=>$model)
<tr id="id-{{ $model->slug }}">
    <td>{{ $models->firstItem()+$key }}.</td>
        <td>
        @if($model->image)
        <img src="{{ asset('/admin/assets/images/services/'.$model->image) }}" alt="" style="width:60px;">
        @else
        <img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
        @endif
    </td> 
    <td>{{ $model->title }}</td>
    <td>
        @if($model->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>{{isset($model->hasCreatedBy)?$model->hasCreatedBy->name:'N/A'}}</td>
    <td width="250px">
        @can('services-edit')
        <a href="{{route('services.edit', $model->slug)}}" data-toggle="tooltip" data-placement="top" title="Edit Service" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('services-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $model->slug }}" data-del-url="{{ url('services', $model->slug) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="8">
        Displying {{$models->firstItem()}} to {{$models->lastItem()}} of {{$models->total()}} records
        <div class="d-flex justify-content-center">
            {!! $models->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
