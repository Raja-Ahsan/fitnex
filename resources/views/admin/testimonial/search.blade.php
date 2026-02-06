@foreach($testimonials as $key=>$testimonial)
    <tr id="id-{{ $testimonial->slug }}">
        <td>{{ $testimonials->firstItem()+$key }}.</td>
        <td>
            @if($testimonial->image)
                <img src="{{ asset('/admin/assets/images/testimonials/'.$testimonial->image) }}" alt="" style="width:60px;">
            @else
                <img src="{{ asset('/admin/assets/images/testimonials/no-photo1.jpg') }}" style="width:60px;">
            @endif
        </td> 
        <td>
            <div class="rating-stars">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $testimonial->rating)
                        <i class="fas fa-star text-warning"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
            </div>
        </td>
        {{-- <td>{!! $testimonial->designation !!}</td> --}}
        <td>{!! \Illuminate\Support\Str::limit($testimonial->comment,60) !!}</td>
        <td>
            @if($testimonial->status)
            <span class="label label-success">Active</span>
            @else
            <span class="label label-danger">In-Active</span>
            @endif
        </td>
        <td>
            @can('testimonial-edit')
                <a href="{{route('testimonial.edit', $testimonial->slug)}}" data-toggle="tooltip" data-placement="top" title="Edit testimonial" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
            @endcan
            @can('testimonial-delete')
                <button class="btn btn-danger btn-xs delete" data-slug="{{ $testimonial->slug }}" data-del-url="{{ url('testimonial', $testimonial->slug) }}"><i class="fa fa-trash"></i> Delete</button>
            @endcan
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="6">
        Displying {{$testimonials->firstItem()}} to {{$testimonials->lastItem()}} of {{$testimonials->total()}} records
        <div class="d-flex justify-content-center">
            {!! $testimonials->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>
<script>
    //delete record
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
