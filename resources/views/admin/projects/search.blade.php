@foreach ($models as $key => $model)
    <tr id="id-{{ $model->id }}">
        <td>{{ $models->firstItem() + $key }}.</td>
        <td> 
            @if($model->image) 
                <img src="{{ asset('/admin/assets/images/projects/'.$model->image) }}" alt="{{ $model->name }}" style="width:60px;"> 
            @else 
                <img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;"> 
            @endif 
        </td>
        <td>{!! \Illuminate\Support\Str::limit($model->company ?? 'N/A', 50) !!}</td>
        <td>{!! \Illuminate\Support\Str::limit($model->name ?? 'N/A', 50) !!}</td>
        
        {{-- <td>{{\Illuminate\Support\Str::limit($model->description,40)}}</td>  --}}
        <td>{!! \Carbon\Carbon::parse($model->start_date)->format('d/M/Y') ?? 'N/A' !!}</td>
        <td>{!! \Carbon\Carbon::parse($model->end_date)->format('d/M/Y') ?? 'N/A' !!}</td>
        {{-- <td>
        @php
            $categories = json_decode($model->project_category_id, true);
            $categoryTitles = [];
            if (is_array($categories)) {
                foreach ($categories as $categoryId) {
                    $title = \App\Models\Category::find($categoryId)->title ?? null;
                    if ($title) {
                        $categoryTitles[] = $title;
                    }
                }
            }
        @endphp
        {{ !empty($categoryTitles) ? implode(', ', $categoryTitles) : 'N/A' }}
    </td> --}}
        @if (Auth::user()->hasRole('Admin'))
            <td>{{ isset($model->hasCreatedBy) ? $model->hasCreatedBy->name : 'N/A' }}
                {{ isset($model->hasCreatedBy) ? $model->hasCreatedBy->last_name : 'N/A' }} <br>
                {{ isset($model->hasCreatedBy) ? $model->hasCreatedBy->role : 'N/A' }}</td>
        @endif
        <td>
            @if ($model->status == 'pending')
                <span class="label label-warning">Pending</span>
            @elseif ($model->status == 'approved')
                <span class="label label-success">Approved</span>
            @elseif ($model->status == 'rejected')
                <span class="label label-danger">Rejected</span>
            @endif
        </td>
        <td>
            <a href="{{ route('projects.show', $model->id) }}"
                class="btn btn-info btn-xs view-project-link"><i class="fa fa-eye"></i> View</a>
            @can('projects-edit')
                <a href="{{ route('projects.edit', $model->id) }}" data-toggle="tooltip" data-placement="top"
                    title="Edit project" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
            @endcan
            @can('projects-delete')
                <button class="btn btn-danger btn-xs delete" data-slug="{{ $model->id }}"
                    data-del-url="{{ url('projects', $model->id) }}">
                    <i class="fa fa-trash"></i> Delete</button>
            @endcan
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="13">
        Displaying {{ $models->firstItem() }} to {{ $models->lastItem() }} of {{ $models->total() }} records
        <div class="d-flex justify-content-center" id="pagination-links" style="margin-top: 20px;">
            {!! $models->links('pagination::bootstrap-4') !!}
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

