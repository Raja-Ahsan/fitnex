@foreach($homesliders as $key=>$homeSlider)
<tr id="id-{{ $homeSlider->id }}">
    <td>{{ $homesliders->firstItem()+$key }}.</td>
    <td>
        @if($homeSlider->image)
        <img src="{{ asset('/admin/assets/images/HomeSlider/'.$homeSlider->image) }}" alt="" style="width:60px;">
        @else
        <img src="{{ asset('/admin/assets/images/HomeSlider/no-photo1.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{!! $homeSlider->title !!}</td>
    <td>{!! $homeSlider->heading !!}</td>
    <td>{!! \Illuminate\Support\Str::limit($homeSlider->description,60) !!}</td>
    <td>
        @if($homeSlider->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>
        @can('homeslider-edit')
        <a href="{{route('homeslider.edit', $homeSlider->id)}}" data-toggle="tooltip" data-placement="top" title="Edit home slider" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('homeslider-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $homeSlider->id }}" data-del-url="{{ url('homeslider', $homeSlider->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="7">
        Displying {{$homesliders->firstItem()}} to {{$homesliders->lastItem()}} of {{$homesliders->total()}} records
        <div class="d-flex justify-content-center">
            {!! $homesliders->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>