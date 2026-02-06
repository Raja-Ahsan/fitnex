@extends('layouts.admin.app')

@section('title', $page_title)

@section('content')
<section class="content-header">
    <h1>{{ $page_title }}</h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Blocked Slots</h3>
            <div class="box-tools pull-right">
                <span class="label label-primary">{{ $blockedSlots->total() }} Total</span>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if($blockedSlots->isEmpty())
                <div class="alert alert-info">
                    <i class="fa fa-info"></i> No blocked slots found.
                </div>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trainer</th>
                            <th>Date</th>
                            <th>Time Range</th>
                            <th>Reason</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blockedSlots as $blocked)
                            <tr>
                                <td>#{{ $blocked->id }}</td>
                                <td>
                                    <strong>{{ $blocked->trainer->name ?? 'N/A' }}</strong>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($blocked->date)->format('M d, Y') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($blocked->start_time)->format('h:i A') }} - 
                                    {{ \Carbon\Carbon::parse($blocked->end_time)->format('h:i A') }}
                                </td>
                                <td>
                                    {{ $blocked->reason ?? '-' }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($blocked->created_at)->format('M d, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $blockedSlots->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

