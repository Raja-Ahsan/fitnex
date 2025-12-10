@foreach($models as $key=>$model)
    <tr id="id-{{ $model->slug }}">
        <td>{{ $models->firstItem()+$key }}.</td>
        {{-- <td>
			@if($model->image)
				<img src="{{ asset('/admin/assets/images/project_category/'.$model->image) }}" alt="" style="width:60px;">
			@else
				<img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
			@endif
		</td> --}}

        <td>{{\Illuminate\Support\Str::limit($model->title,40)}}</td>
        {{-- <td>
            @if($model->parent_id)
            <span class="label label-primary">{{\Illuminate\Support\Str::limit($model->parent_id,40)}}</span>
            @else
            <span class="badge badge-danger">Main Category</span>
            @endif
        </td> --}}
        {{-- <td>{{\Illuminate\Support\Str::limit($model->description,40)}}</td>  --}}
		
        <td>
            @if($model->status)
                <span class="label label-success">Active</span>
            @else
                <span class="label label-danger">In-Active</span>
            @endif
        </td>
        <td>{{isset($model->hasCreatedBy)?$model->hasCreatedBy->name:'N/A'}}</td>
        <td width="250px">
            @can('project_category-edit')
                <a href="{{route('project_category.edit', $model->slug)}}" data-toggle="tooltip" data-placement="top" title="Edit service" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
            @endcan
            @can('project_category-delete')
                <button class="btn btn-danger btn-xs delete" data-slug="{{ $model->slug }}" data-del-url="{{ url('project_category', $model->slug) }}"><i class="fa fa-trash"></i> Delete</button>
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
<script>
    $('.delete').on('click', function() {
        var slug = $(this).attr('data-slug');
        var delete_url = $(this).attr('data-del-url');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: delete_url,
                    type: 'DELETE',
                    success: function(response) {
                        // console.log(response);
                        if (response) {
                            $('#id-' + slug).hide();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Not Deleted!',
                                'Sorry! Something went wrong.',
                                'danger'
                            )
                        }
                    }
                });
            }
        })
    });
</script>