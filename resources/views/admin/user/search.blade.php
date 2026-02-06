@foreach($users as $key => $user)
<tr id="id-{{ $user->id }}">
    <td>{{ $users->firstItem() + $key }}.</td>
    <!--  @if(Auth::user()->hasRole('Admin'))
        <td>
            @if($user->role == 'EPC Developer')
            <span class="label label-warning">EPC Developer</span>
            @elseif($user->role == 'Contractor')
            <span class="label label-info">Contractor</span>
            @else
            {{ $user->role }}
            @endif
        </td>
    @endif -->
    <td>
        @if($user->image)
        <img src="{{ asset('/admin/assets/images/UserImage') }}/{{ $user->image }}" style="width:60px;" alt="">
        @else
        <img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->phone ?? 'N/A' }}</td>
    <td>{{ $user->email }}</td>
    <td>{!! format_address($user->designation, 10) !!}</td>
    @if(Auth::user()->hasRole('Admin'))
    <td>
        @if($user->date_of_birth)
        {{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years
        @else
        N/A
        @endif
    </td>
    <td>
        {{ $user->team }}
    </td>
    <td>
        <span class="label {{ $user->gender === 'Male' ? 'label-men' : ($user->gender === 'Female' ? 'label-women' : '') }}">
            {!! \Illuminate\Support\Str::limit($user->gender ?? 'N/A', 50) !!}
        </span>
    </td>
    <td>
        @if($user->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>
        @if($user->top_rated)
        <span class="label label-success">YES</span>
        @else
        <span class="label label-danger">NO</span>
        @endif
    </td>
    <td>
        @if($user->leaderboard)
        <span class="label label-success">YES</span>
        @else
        <span class="label label-danger">NO</span>
        @endif
    </td>
    <td>
        @can('user-edit')
        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('user-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $user->id }}" data-del-url="{{ url('user', $user->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
    @endif
</tr>
@endforeach

<tr>
    <td colspan="13">
        <div class="d-flex justify-content-center">
            {!! $users->links('pagination::bootstrap-4') !!}
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