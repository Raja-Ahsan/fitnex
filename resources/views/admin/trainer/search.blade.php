@foreach($trainers as $key=>$trainer)
<tr id="id-{{ $trainer->slug }}">
    <td>{{ $trainers->firstItem()+$key }}.</td>
    <td>
        @if($trainer->image)
        <img src="{{ asset('/admin/assets/images/Trainers/'.$trainer->image) }}" alt="" style="width:60px;">
        @else
        <img src="{{ asset('/admin/assets/images/Trainers/no-photo1.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{{ $trainer->trainer_type }}</td>
    <td>{{ $trainer->name }}</td>
    <td>{{ $trainer->designation }}</td>
 {{--    <td>{{ $trainer->email }}</td>
    <td>{{ $trainer->phone }}</td> --}}
    <td style="max-width: 200px;">{{ $trainer->description }}</td>
    <td>${{ $trainer->price }}</td> 
    <td>
        <div class="rating-stars">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $trainer->rating)
                    <i class="fas fa-star text-warning"></i>
                @else
                    <i class="far fa-star"></i>
                @endif
            @endfor
        </div>
    </td>
    <td>
        @if($trainer->specialization)
        @foreach(json_decode($trainer->specialization, true) as $specialization)
            <li class="list-inline-item">{{ $specialization }}</li>
        @endforeach
        @endif
    </td> 
    <td>{{ $trainer->instagram }}</td> 
    <td>{{ $trainer->google_calendar_id }}</td>
    <td>
        @if($trainer->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>{{isset($trainer->hasCreatedBy)?$trainer->hasCreatedBy->name:'N/A'}}</td>
    <td style="max-width: 100px;">
        <div style="display: flex; gap: 5px;">
            @can('trainer-edit')
            <a href="{{route('trainer.edit', $trainer->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Trainer" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
            @endcan
            @can('trainer-delete')
            <button class="btn btn-danger btn-xs delete" data-slug="{{ $trainer->id }}" data-del-url="{{ url('trainer', $trainer->id) }}" data-toggle="tooltip" data-placement="top" title="Delete Trainer"><i class="fa fa-trash"></i></button>
            @endcan
        </div>
    </td>
</tr>
@endforeach
<tr>
    <td colspan="13">
        Displying {{$trainers->firstItem()}} to {{$trainers->lastItem()}} of {{$trainers->total()}} records
        <div class="d-flex justify-content-center">
            {!! $trainers->links('pagination::bootstrap-4') !!}
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

