@foreach($models as $key=>$event)
<tr id="id-{{ $event->id }}">
    <td>{{ $models->firstItem()+$key }}.</td>
    <td>{!! \Illuminate\Support\Str::limit($event->title,40) !!}</td>
    <td>{!! \Illuminate\Support\Str::limit($event->host,60) !!}</td>
    <td>{!! \Carbon\Carbon::parse($event->date)->format('d-m-Y') !!}</td>
    <td>{!! \Carbon\Carbon::parse($event->time)->format('h:i A') !!} - {!! \Carbon\Carbon::parse($event->end_time)->format('h:i A') !!}</td>
    {{-- <td>
        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->location) }}" target="_blank">
            {!! \Illuminate\Support\Str::limit($event->location,60) !!}
        </a>
    </td> --}}
    <td>
        @if(!empty($event->location_link))
            <a href="{{ $event->location_link }}" target="_blank">{{ $event->location }}</a>
        @else
            <span>{{ $event->location }}</span>
        @endif
    </td>
    <td><a href="{{ $event->registration_link }}" target="_blank">{{ $event->registration_link }}</a></td>
    <td>
        @if($event->status)
        <span class="label label-success">Active</span>
        @else
        <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td width="250px">
        <a href="{{route('event.show', $event->id)}}" data-toggle="tooltip" data-placement="top" title="Show event" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a>
        @can('event-edit')
        <a href="{{route('event.edit', $event->id)}}" data-toggle="tooltip" data-placement="top" title="Edit event" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('event-delete')
        <button class="btn btn-danger btn-xs delete" data-slug="{{ $event->id }}" data-del-url="{{ url('event', $event->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="9">
        Displying {{$models->firstItem()}} to {{$models->lastItem()}} of {{$models->total()}} records
        <div class="d-flex justify-content-center">
            {!! $models->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>