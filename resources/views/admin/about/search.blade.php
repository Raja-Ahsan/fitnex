@foreach($abouts as $key=>$about)
<tr id="id-{{ $about->slug }}">
    <td>{{ $abouts->firstItem()+$key }}.</td>
    <td>
        @if($about->image)
            <img src="{{ asset('/admin/assets/images/about/'.$about->image) }}" alt="" style="width:60px;">
        @else
            <img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{{($about->heading)}}</td>
    <td>{{\Illuminate\Support\Str::limit($about->short_description,60)}}</td> 
    <td>{!! \Illuminate\Support\Str::limit($about->description,60) !!}</td>
    <td>
        @if($about->status)
            <span class="label label-success">Active</span>
        @else
            <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>{{isset($about->hasCreatedBy)?$about->hasCreatedBy->name:'N/A'}}</td>
    <td width="250px">
    @can('about-edit')
        <a href="{{route('about.edit', $about->id)}}" data-toggle="tooltip" data-placement="top" title="Edit About" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
    @endcan
    <!-- @can('about-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $about->slug }}" data-del-url="{{ url('about', $about->slug) }}"><i class="fa fa-trash"></i> Delete</button>
    @endcan -->
    </td>
</tr>
@endforeach
<tr>
<td colspan="6">
    <div class="d-flex justify-content-center">
        {!! $abouts->links('pagination::bootstrap-4') !!}
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