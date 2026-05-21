@foreach($models as $key=>$model)
<tr id="id-{{ $model->id }}">
    <td>{{ $models->firstItem()+$key }}.</td>
    <td>{{\Illuminate\Support\Str::limit($model->name,40)}}</td>
    <td>
        @if($model->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td width="250px">
        @can('blog_category-edit')
        <a href="{{route('blog_category.edit', $model->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Blog Category" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('blog_category-delete')
        <button class="btn btn-danger btn-xs delete" data-id="{{ $model->id }}" data-del-url="{{ url('blog_category', $model->id) }}"><i class="fa fa-trash"></i> Delete</button>
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
