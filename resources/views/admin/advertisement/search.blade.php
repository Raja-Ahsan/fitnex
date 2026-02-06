@foreach($advertisements as $key=>$advertisement)
<tr id="id-{{ $advertisement->id }}">
    <td>{{ $advertisements->firstItem()+$key }}.</td>
    <td>
        @if($advertisement->image)
        <img src="{{ asset('/admin/assets/images/advertisement') }}/{{ $advertisement->image }}" style="width:60px;" alt="">
        @else
        <img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{{ $advertisement->name }}</td>
    <td>{!! \Illuminate\Support\Str::limit( $advertisement->short_description , 20) !!}</td>
    <!-- Fetch city name -->
    <td>{{ $advertisement->hasCity ? $advertisement->hasCity->city : 'N/A' }}</td>
    <!-- Fetch state name -->
    <td>{{ $advertisement->hasState ? $advertisement->hasState->state : 'N/A' }}</td>
    <td>
        @if($advertisement->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>{{isset($advertisement->hasCreatedBy)?$advertisement->hasCreatedBy->name:'N/A'}}</td>
    <td width="250px">
        @can('advertisement-edit')
        <a href="{{route('advertisement.edit', $advertisement->id)}}" data-toggle="tooltip" data-placement="top" title="Edit advertisement" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('advertisement-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $advertisement->id }}" data-del-url="{{ url('advertisement', $advertisement->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="9">
        <div class="d-flex justify-content-center">
            {!! $advertisements->links('pagination::bootstrap-4') !!}
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