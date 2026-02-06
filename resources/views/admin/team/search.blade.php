@foreach($teams as $key=>$team)
<tr id="id-{{ $team->id }}">
    <td>{{ $teams->firstItem()+$key }}.</td>
    <td>
        @if($team->image)
        <img src="{{ asset('/admin/assets/images/team/'.$team->image) }}" alt="" style="width:60px;">
        @else
        <img src="{{ asset('/admin/assets/images/team/no-photo1.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{{ $team->name }}</td>
    <td>{{ $team->designation }}</td>
    <td>
        @if($team->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>
        @can('meet_the_team-edit')
        <a href="{{route('meet_the_team.edit', $team->id)}}" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('meet_the_team-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $team->id }}" data-del-url="{{ url('meet_the_team', $team->id) }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="8">
        Displying {{$teams->firstItem()}} to {{$teams->lastItem()}} of {{$teams->total()}} records
        <div class="d-flex justify-content-center">
            {!! $teams->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
<script>
    //delete record
    $('.delete').on('click', function() {
        var id = $(this).attr('data-slug');
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
                            $('#id-' + id).hide();
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
