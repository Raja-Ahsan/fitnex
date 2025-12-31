@foreach($jobposts as $key=>$jobpost)
<tr id="id-{{ $jobpost->id }}">
    <td>{{ $jobposts->firstItem()+$key }}.</td>
    <td>
        @if($jobpost->image)
        <img src="{{ asset('/admin/assets/images/jobpost') }}/{{ $jobpost->image }}" style="width:60px;" alt="">
        @else
        <img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{{ $jobpost->name }}</td>
    <td>{!! \Illuminate\Support\Str::limit($jobpost->county ?? 'N/A', 50) !!}</td>
    {{-- <td>{!! \Illuminate\Support\Str::limit( $jobpost->short_description , 20) !!}</td>  --}}
    <td>
        @if($jobpost->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>{{isset($jobpost->hasCreatedBy)?$jobpost->hasCreatedBy->name:'N/A'}}</td>
    <td width="250px">
        @can('jobpost-edit')
        <a href="{{route('jobpost.edit', $jobpost->id)}}" data-toggle="tooltip" data-placement="top" title="Edit jobpost" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('jobpost-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $jobpost->id }}" data-del-url="{{ url('jobpost', $jobpost->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="9">
        <div class="d-flex justify-content-center">
            {!! $jobposts->links('pagination::bootstrap-4') !!}
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