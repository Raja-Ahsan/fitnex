@foreach($models as $key=>$model)
<tr id="id-{{ $model->id }}">
    <td>{{ $models->firstItem()+$key }}.</td>
    <td>
        @if ($model->package_for == 1)
            <span class="label label-member">Member</span>
        @elseif ($model->package_for == 2)
            <span class="label label-epc">EPC Developer</span>
        @else
            N/A
        @endif
    </td> 
    <td>{!! \Illuminate\Support\Str::limit($model->title,40) !!}</td>
    <td>{{$model->period}}</td>
    <td>${!! \Illuminate\Support\Str::limit($model->price ?? '0.00', 50) !!}</td>
    <td>{!! \Illuminate\Support\Str::limit($model->description, 70) !!}</td>
    <td>{{isset($model->hasCreatedBy)?$model->hasCreatedBy->name:'N/A'}}</td>
    <td>
        @if($model->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>
        @can('package-edit')
        <a href="{{route('package.edit', $model->id)}}" data-toggle="tooltip" data-placement="top" title="Edit model" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('package-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}" data-del-url="{{ url('package', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="10">
        Displying {{$models->firstItem()}} to {{$models->lastItem()}} of {{$models->total()}} records
        <div class="d-flex justify-content-center">
            {!! $models->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
