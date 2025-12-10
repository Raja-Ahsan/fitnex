@extends(((Auth::user()->hasRole('Admin')) ? 'layouts.admin.app' : 'layouts.customer.app'))
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('user.index') }}">
<section class="content-header">
    <div class="content-header-left">
        @if(Auth::user()->hasRole('Admin'))
        <h1>All Users</h1>
        @else
        <h1>All Contractors</h1>
        @endif
    </div>
    <!-- @can('user-create')
        <div class="content-header-right">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Add New</a>
        </div>
    @endcan  -->
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
            <div class="callout callout-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="box box-info">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-1">Search:</div>
                        <div class="d-flex col-sm-10" style="margin-bottom: 10px;">
                            <input type="text" id="search" class="form-control" placeholder="Search">
                        </div>
                        <div class="d-flex col-sm-5">
                            <select name="" id="status" class="form-control status" style="margin-bottom:5px; display: none;">
                                <option value="All" selected>Search by status</option>
                                <option value="1">Active</option>
                                <option value="2">In-Active</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table id="" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                   <!--  @if(Auth::user()->hasRole('Admin'))
                                    <th>Role</th>
                                    @endif -->
                                    <th>Image</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>E-mail</th>
                                    <th>Designation</th>
                                    @if(Auth::user()->hasRole('Admin'))
                                    <th>Age</th>
                                    <th>Team</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Top Rated</th>
                                    <th>Leaderboard</th>
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="body">
                                @foreach($users as $key => $user)
                                <tr id="id-{{ $user->id }}">
                                    <td>{{ $users->firstItem() + $key }}.</td>
                                   <!--  @if(Auth::user()->hasRole('Admin'))
                                    <td>
                                        @if($user->role == 'EPC Developer')
                                        <span class="label label-warning">EPC Developer</span>
                                        @elseif($user->role == 'Contractor')
                                        <span class="label label-info">Contractor</span>
                                        @else
                                        {{ $user->role }}
                                        @endif
                                    </td>
                                    @endif -->
                                    <td>
                                        @if($user->image)
                                        <img src="{{ asset('/admin/assets/images/UserImage') }}/{{ $user->image }}" style="width:60px;" alt="">
                                        @else
                                        <img src="{{ asset('/admin/assets/images/default.jpg') }}" style="width:60px;">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{!! format_address($user->designation, 10) !!}</td>
                                    @if(Auth::user()->hasRole('Admin'))
                                    <td>
                                        @if($user->date_of_birth)
                                        {{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>
                                        {{ $user->team }}
                                    </td>
                                    <td>
                                        <span class="label {{ $user->gender === 'Male' ? 'label-men' : ($user->gender === 'Female' ? 'label-women' : '') }}">
                                            {!! \Illuminate\Support\Str::limit($user->gender ?? 'N/A', 50) !!}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->status)
                                        <span class="label label-success">Active</span>
                                        @else
                                        <span class="label label-danger">In-Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->top_rated)
                                        <span class="label label-success">YES</span>
                                        @else
                                        <span class="label label-danger">NO</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->leaderboard)
                                        <span class="label label-success">YES</span>
                                        @else
                                        <span class="label label-danger">NO</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('user-edit')
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('user-delete')
                                        <button class="btn btn-danger btn-xs delete" data-slug="{{ $user->id }}" data-del-url="{{ url('user', $user->id) }}"><i class="fa fa-trash"></i> Delete</button>
                                        @endcan
                                    </td>
                                    @endif
                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="13">
                                        <div class="d-flex justify-content-center">
                                            {!! $users->links('pagination::bootstrap-4') !!}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

@push('js')
@endpush