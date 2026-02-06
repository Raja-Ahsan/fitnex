@foreach($models as $key=>$blog)
<tr id="id-{{ $blog->id }}">
    <td>{{ $models->firstItem()+$key }}.</td>
    <td>{!! \Illuminate\Support\Str::limit($blog->title,40) !!}</td>
    <td>{{isset($blog->hasCategory)?$blog->hasCategory->name:'N/A'}}</td> 
    <td>{{isset($blog->hasCreatedBy)?$blog->hasCreatedBy->name:'N/A'}}</td>
    <td>
        @if($blog->status)
        <span class="label label-success">Published</span>
        @else
        <span class="label label-warning">Draft</span>
        @endif
    </td>
    <td>{{ $blog->created_at->format('d-M-Y') }}</td>

    <td width="250px">
        <a href="{{route('blog.show', $blog->id)}}" data-toggle="tooltip" data-placement="top" title="Show blog" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a>
        @can('blog-edit')
        <a href="{{route('blog.edit', $blog->id)}}" data-toggle="tooltip" data-placement="top" title="Edit blog" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('blog-delete')
        <button class="btn btn-danger btn-xs delete" data-slug ="{{ $blog->id }}" data-del-url="{{ url('blog', $blog->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="9">
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