@foreach($permissions as $key=>$permission)
<tr id="id-{{ $permission->id }}">
    <td>{{ $permissions->firstItem()+$key }}.</td>
    <td>{{ Str::ucfirst($permission->name) }}</td>
    <td>{{$permission->guard_name}}</td>
    <td>
        @can('permission-edit')
        <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('permission-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $permission->id }}" data-del-url="{{ url('permission', $permission->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="4">
        Displying {{$permissions->firstItem()}} to {{$permissions->lastItem()}} of {{$permissions->total()}} records
        <div class="d-flex justify-content-center">
            {!! $permissions->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
<script>
    //delete record
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