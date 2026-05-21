@foreach($models as $key=>$model)
<tr id="id-{{ $model->slug }}">
    <td>{{  $models->firstItem()+$key }}.</td>
    <td>{!! $model->title??'N/A' !!}</td>
    <td>{!! \Illuminate\Support\Str::limit($model->description??'N/A',60) !!}</td>
    <td>
        @if($model->status)
            <span class="badge badge-success">Active</span>
        @else
            <span class="badge badge-danger">In-Active</span>
        @endif
    </td>
    <td width="250px">
        @can('page-edit')
            <a href="{{route('page.edit', $model->slug)}}" data-toggle="tooltip" data-placement="top" title="Edit page" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('page-delete')
            <button class="btn btn-danger btn-xs delete" data-slug="{{ $page->slug }}" data-del-url="{{ url('page', $page->slug) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan

        <a href="{{route('page_setting.show', $model->slug)}}" data-toggle="tooltip" data-placement="top" title="Page Setting" class="btn btn-info btn-xs"><i class="fa fa-cog"></i> Setting</a>
    </td>
</tr>
@endforeach
<tr>
<td colspan="8">

    <div class="d-flex justify-content-center">
        {!! $models->links('pagination::bootstrap-4') !!}
    </div>
</td>
</tr>
