@foreach($news_letters as $key=>$news_letter)
<tr id="id-{{ $news_letter->id }}">
    <td>{{ $news_letters->firstItem()+$key }}.</td>
    <!-- <td>{{$news_letter->name}}</td> -->
    <td>{{$news_letter->email}}</td>
    <td>
        @if($news_letter->status)
            <span class="label label-success">Active</span>
        @else
            <span class="label label-danger">In-Active</span>
        @endif
    </td>
    <td>
        @can('newsletter-edit')
            <a href="{{route('newsletter.edit', $news_letter->id)}}" data-toggle="tooltip" data-placement="top" title="Edit NewsLetter" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
        @endcan
        @can('newsletter-delete')
            <button class="btn btn-danger btn-xs delete" data-slug="{{ $news_letter->id }}" data-del-url="{{ url('newsletter', $news_letter->id) }}"><i class="fa fa-trash"></i> Delete</button>
        @endcan
    </td>
</tr>
@endforeach
<tr>
    <td colspan="6">
        <div class="d-flex justify-content-center">
            {!! $news_letters->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>