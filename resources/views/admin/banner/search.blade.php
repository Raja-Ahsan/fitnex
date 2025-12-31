@foreach($banners as $key=>$banner)
<tr id="id-{{ $banner->id }}">
    <td>{{ $banners->firstItem()+$key }}.</td>
    <td>
        @if($banner->image)
            <img src="{{ asset('/admin/assets/images/banner') }}/{{ $banner->image }}" style="width:60px;" alt="">
        @else
            <img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{{ $banner->name }}</td>
    <td>{{ $pages[$banner->slug] ?? $banner->slug }}</td>
    <td>
        @if($banner->status)
            <span class="label label-success">Active</span>
        @else
            <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td width="250px">
        @can('banner-edit')
            <a href="{{route('banner.edit', $banner->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Banner" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('banner-delete')
            <button class="btn btn-danger btn-xs delete" data-slug="{{ $banner->id }}" data-del-url="{{ url('banner', $banner->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="6">
        <div class="d-flex justify-content-center">
            {!! $banners->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>

<script>
$('.delete').on('click', function(){
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
                url : delete_url,
                type : 'DELETE',
                success : function(response){
                    // console.log(response);
                    if(response){
                        $('#id-'+slug).hide();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }else{
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