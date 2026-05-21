@foreach($agents as $key=>$agent)
<tr id="id-{{ $agent->slug }}">
    <td>{{ $agents->firstItem()+$key }}.</td>
    <td>
        @if($agent->image)
            <img src="{{ asset('/admin/assets/images/Agents/'.$agent->image) }}" alt="" style="width:60px;">
        @else
            <img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}" style="width:60px;">
        @endif
    </td>
    <td>{{ $agent->name }}</td>
    <td>{{ $agent->designation }}</td>
    <td>{{ $agent->facebook }}</td>
    <td>{{ $agent->twitter }}</td>
    <td>{{ $agent->instagram }}</td>
    <td>{{ $agent->behance }}</td>
    <td>{{ $agent->youtube }}</td>
    <td>
        @if($agent->status)
        <span class="badge badge-success">Active</span>
        @else
        <span class="badge badge-danger">In-Active</span>
        @endif
    </td>
    <td>{{isset($agent->hasCreatedBy)?$agent->hasCreatedBy->name:'N/A'}}</td>
    <td>
        @can('agents-edit')
            <a href="{{route('agents.edit', $agent->slug)}}" data-toggle="tooltip" data-placement="top" title="Edit Agents" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('agents-delete')
            <button class="btn btn-danger btn-xs delete" data-slug="{{ $agent->slug }}" data-del-url="{{ url('agents', $agent->slug) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
<td colspan="6">
    Displying {{$agents->firstItem()}} to {{$agents->lastItem()}} of {{$agents->total()}} records
    <div class="d-flex justify-content-center">
        {!! $agents->links('pagination::bootstrap-4') !!}
    </div>
</td>
</tr>
