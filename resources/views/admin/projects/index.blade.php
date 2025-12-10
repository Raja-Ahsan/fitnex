@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.member.app')))
@section('title', $page_title)
@section('content')
<input type="hidden" id="page_url" value="{{ route('projects.index') }}">
<section class="content-header">
    <div class="content-header-left">
        <h1>Project Listings</h1>
    </div>
    @can('projects-create')
    <div class="content-header-right">
        <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm">Add New Project</a>
    </div>
    @endcan
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="callout callout-success">
                {{ session('status') }}
            </div>
            @endif

            <div class="box box-info">
                <div class="box-body">
                    <div class="row" style="margin-bottom: 10px;">
						<div class="d-flex col-sm-8">
							<input type="text" id="search" class="form-control" placeholder="Search by:  Company | Project Name | Start Date">
						</div>
						<div class="d-flex col-sm-4">
                            <select name="" id="status" class="form-control status" style="margin-bottom:5px">
                                <option value="All" selected>Search by status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
						</div>
					</div>
                    <div class="card-body table-responsive p-0">
                        <table id="" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Project Image</th>
                                    <th>Company</th>
                                    <th>Project Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    @if(Auth::user()->hasRole('Admin'))
                                    <th>Created by</th>
                                    @endif
                                    <th>Status</th>
                                    <th width="220">Action</th>
                                </tr>
                            </thead>
                            <tbody id="body">
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
                                    @if(Auth::user()->hasRole('Admin'))
                                    <td>{{isset($model->hasCreatedBy)?$model->hasCreatedBy->name:'N/A'}} {{isset($model->hasCreatedBy)?$model->hasCreatedBy->last_name:'N/A'}} <br> {{isset($model->hasCreatedBy)?$model->hasCreatedBy->role:'N/A'}}</td>
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
                                        <a href="{{ route('projects.edit', $model->id) }}"
                                            data-toggle="tooltip" data-placement="top" title="Edit project"
                                            class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('projects-delete')
                                        <button class="btn btn-danger btn-xs delete"
                                            data-slug="{{ $model->id }}"
                                            data-del-url="{{ url('projects', $model->id) }}">
                                            <i class="fa fa-trash"></i> Delete</button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="13">
                                        Displaying {{ $models->firstItem() }} to {{ $models->lastItem() }} of
                                        {{ $models->total() }} records
                                        <div class="d-flex justify-content-center" id="pagination-links" style="margin-top: 20px;">
                                            {!! $models->links('pagination::bootstrap-4') !!}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
	$(document).ready(function() {
		// Function to load projects via AJAX
		function loadProjects(url, pushToHistory = true) {
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'html',
				success: function(data) {
					console.log('AJAX success function reached.');
					var $html = $(data);
					$('#body').html($html.find('#body').html());
					$('#pagination-links').html($html.find('#pagination-links').html());
	
					// Update URL in browser without reloading
					if (pushToHistory) {
						console.log('Calling history.pushState with URL:', url);
						history.pushState(null, '', url);
						console.log('history.pushState called. Current URL:', window.location.href);
					}
				},
				error: function(xhr, status, error) {
					console.error("AJAX Error:", status, error);
					console.error(xhr.responseText);
				}
			});
		}
	
		// Handle pagination link clicks - Use e.preventDefault() for AJAX
		$(document).on('click', '#pagination-links a', function(e) {
			e.preventDefault(); // Prevent default link behavior
			var newUrl = $(this).attr('href');
			if (newUrl) {
				loadProjects(newUrl);
			}
		});
	
		// Handle browser back/forward buttons after a direct visit or initial load
		$(window).on('popstate', function() {
			var currentPageUrl = window.location.href;
			console.log('Popstate triggered. Loading URL:', currentPageUrl);
			// Ensure we only load if we are on the member_directory index page
			if (currentPageUrl.includes('projects')) {
				loadProjects(currentPageUrl, false); // Don't push again to history
			}
		});
	
		// Handle search input
		$('#search').on('keyup', function() {
			var search = $(this).val();
			var status = $('#status').val();
			// Use the base URL from the hidden input
			var url = $('#page_url').val();
			// Append search and status parameters
			url += '?search=' + search + '&status=' + status;
			loadProjects(url);
		});
	
		// Handle status dropdown change
		$('#status').on('change', function() {
			var status = $(this).val();
			var search = $('#search').val();
			// Use the base URL from the hidden input
			var url = $('#page_url').val();
			// Append search and status parameters
			url += '?search=' + search + '&status=' + status;
			loadProjects(url);
		});
	
		// Handle clicks on View links
		$(document).on('click', '.view-project-link', function(e) {
			e.preventDefault(); // Prevent default link navigation
	
			var baseUrl = $(this).attr('href');
			var currentQueryString = window.location.search; // Get the current query string (e.g., ?page=2)
	
			// Combine the base URL and the current query string
			var newUrl = baseUrl + currentQueryString;
	
			// Navigate to the new URL
			window.location.href = newUrl;
		});
	
	});
	</script>
@endpush