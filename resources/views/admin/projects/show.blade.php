@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.contractor.app')))
@section('title', $page_title)
@section('content')
<style>
    /* body, .content, .container {
        background: #f4f7fa !important;
    } */
    .project-card {
        max-width: 850px;
        margin: 40px auto;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        background: #fff;
        padding: 0;
    }
    .project-header {
        background: linear-gradient(90deg, #cb8900 0%, #ac790c 100%);
        border-radius: 18px 18px 0 0;
        padding: 32px 24px 16px 24px;
        text-align: center;
        color: #fff;
    }
    .project-header img {
        width: 25%;
        margin-bottom: 10px;
        border-radius: 5px;
    }
    .project-header h2 {
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 0;
        font-size: 3rem;
        text-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .project-info-row {
        display: flex;
        flex-wrap: wrap;
        gap: 0 24px;
        padding: 24px 24px 0 24px;
    }
    .project-info-col {
        flex: 1 1 220px;
        min-width: 220px;
        margin-bottom: 16px;
    }
    .project-info-label {
        font-weight: 600;
        color: #1e293b;
        font-size: 2rem;
    }
    .project-info-value {
        color: #475569;
        font-size: 1.5rem;
        margin-top: 2px;
    }
    .project-section {
        padding: 0 24px 18px 24px;
    }
    .project-section-title {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 6px;
        font-size: 1.5rem;
    }
    .project-logo {
        display: block;
        margin: 12px 0 0 0;
        max-width: 120px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    .project-doc-list {
        padding-left: 0;
        margin-bottom: 0;
    }
    .project-doc-list li {
        list-style: none;
        margin-bottom: 6px;
    }
    .project-doc-link {
        color: #1e40af;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }
    .project-doc-link:hover {
        color: #2563eb;
        text-decoration: underline;
    }
    @media (max-width: 600px) {
        .project-card { max-width: 98vw; }
        .project-info-row, .project-section { padding: 16px 8px 0 8px; }
        .project-section { padding-bottom: 12px; }
    }
    .file-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        margin-top: 18px;
    }
    .file-item {
        position: relative;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(31, 41, 55, 0.08);
        width: 160px;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 18px 10px 12px 10px;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .file-item:hover {
        box-shadow: 0 6px 18px rgba(31, 41, 55, 0.16);
        transform: translateY(-4px) scale(1.03);
    }
    .file-icon, .file-image {
        width: 60px;
        height: 60px;
        margin-bottom: 10px;
        object-fit: contain;
    }
    .file-item .remove-file {
        position: absolute;
        top: 8px;
        right: 10px;
        color: #e11d48;
        background: #fff;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 1.1rem;
        cursor: pointer;
        display: none;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        transition: background 0.2s;
    }
    .file-item .remove-file:hover {
        background: #fee2e2;
    }
    .file-item:hover .remove-file {
        display: block;
    }
    .file-item .file-name {
        font-size: 13px;
        color: #334155;
        margin-top: 8px;
        word-break: break-all;
        text-align: center;
        font-weight: 500;
    }
    .content-header .content-header-left h1:before {
        position: absolute;
        top: 0;
        left: 0;
        font-family: 'FontAwesome', sans-serif;
        font-size: 26px;
        content: '\f0a8'; /* Changed to fa-arrow-circle-left icon */
    }
    .content-header-left:hover {
        cursor: pointer;
    }
    .content-header-left:hover h1:before {
        color: #b27c0a;
    }
</style>

<section class="content-header">
    <div class="content-header-left">
        @php
            $currentPage = request()->query('page', 1);
        @endphp
        <a href="{{ route('projects.index', ['page' => $currentPage]) }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
    </div>
    @push('js')
    <script>
        console.log('Page parameter in URL:', '{{ request()->query('page') }}');
        
        // Add click handler to the header area
        $('.content-header-left').on('click', function() {
            var currentPage = '{{ request()->query('page', 1) }}';
            var indexUrl = '{{ route('projects.index', ['page' => '__PAGE__']) }}';
            indexUrl = indexUrl.replace('__PAGE__', currentPage);
            window.location.href = indexUrl;
        });
    </script>
    @endpush
    <div class="content-header-right">
        <a href="{{ route('projects.index') }}" class="btn btn-primary btn-sm">View All</a>
        {{-- <a href="{{ route('projects.pdf', $project->id) }}" class="btn btn-primary btn-sm">Download PDF</a> --}}
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="project-card">
            <div class="project-header">
                <img src="{{ asset('/admin/assets/images/page') }}/{{ $home_page_data['header_logo'] }}" alt="Logo">
                <h2>Project Details</h2>
            </div>
            <div class="project-info-row">
                <div class="project-info-col">
                    <div class="project-info-label">Project Name</div>
                    <div class="project-info-value">{{ ucfirst($project->name) ?? 'N/A' }}</div>
                </div>
                <div class="project-info-col">
                    <div class="project-info-label">Company</div>
                    <div class="project-info-value">{{ $project->company ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="project-info-row">
                <div class="project-info-col">
                    <div class="project-info-label">Project Category</div>
                    <div class="project-info-value">
                        @php
                            $categories = json_decode($project->project_category_id, true);
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
                    </div>
                </div>
                <div class="project-info-col">
                    <div class="project-info-label">Alliance Area</div>
                    <div class="project-info-value">
                        @php
                            $counties = json_decode($project->county, true);
                        @endphp
                        @if(is_array($counties))
                            {{ implode(', ', $counties) }}
                        @else
                            N/A
                        @endif
                    </div>
                </div>
            </div>
            <div class="project-info-row">
                <div class="project-info-col">
                    <div class="project-info-label">Start Date</div>
                    <div class="project-info-value">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d/M/Y') : 'N/A' }}</div>
                </div>
                <div class="project-info-col">
                    <div class="project-info-label">End Date</div>
                    <div class="project-info-value">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d/M/Y') : 'N/A' }}</div>
                </div>
            </div>
            <div class="project-info-row">
                <div class="project-info-col">
                    <div class="project-section-title">Project POC (Name, Phone, Email)</div>
                    <div class="project-info-value">{{ $project->poc_name ?? 'N/A' }}</div>
                    <div class="project-info-value">{{ $project->poc_phone ?? 'N/A' }}</div>
                    <div class="project-info-value">{{ $project->poc_email ?? 'N/A' }}</div>
                </div>
                <div class="project-info-col"> 
                    <div class="project-section-title">Project Description</div>
                    <div class="project-info-value">{{ $project->description ?? 'N/A' }}</div> 
                </div>
            </div> 
            <div class="project-info-row"> 
                <div class="project-info-col"> 
                    <div class="project-section-title">Key Links</div>
                    <div class="project-info-value">
                        @php
                            $keyLinks = json_decode($project->key_links, true);
                        @endphp
                        @if(!empty($keyLinks))
                            <ul class="project-doc-list">
                                @foreach($keyLinks as $link)
                                    <li>
                                        @if(isset($link['url']) && !empty($link['url']))
                                            <a href="{{ $link['url'] }}" target="_blank" class="project-doc-link">
                                                {{ $link['label'] ?? $link['url'] }}
                                            </a>
                                        @else
                                            {{ $link['label'] ?? 'N/A' }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            N/A
                        @endif
                    </div> 
                </div>
            </div> 
             
            <div class="project-info-row">
                {{-- Logic for EPC Developer or Member --}}
                @if(Auth::user()->hasRole('EPC Developer') || Auth::user()->hasRole('Member'))
                    <div class="project-info-col">
                        <div class="project-section-title">Project Status</div>
                        <div class="project-info-value">
                            @if ($project->status == 'pending')
                                <span class="label label-warning">Pending</span>
                            @elseif ($project->status == 'approved')
                                <span class="label label-success">Approved</span>
                            @elseif ($project->status == 'rejected')
                                <span class="label label-danger">Rejected</span>
                            @endif
                        </div>
                    </div>
                    {{-- Conditionally show Rejection Reason if status is rejected --}}
                    @if ($project->status == 'rejected')
                        <div class="project-info-col">
                            <div class="project-section-title">Rejection Reason</div>
                            <div class="project-info-value">
                                {{ $project->rejection_reason ?? 'N/A' }}
                            </div>
                        </div>
                    @endif
                @endif

                {{-- Logic for Admin --}}
                @if(Auth::user()->hasRole('Admin'))
                    <div class="project-info-col">
                        <div class="project-section-title">Project Status</div>
                        <div class="project-info-value">
                            @if ($project->status == 'pending')
                                <span class="label label-warning">Pending</span>
                            @elseif ($project->status == 'approved')
                                <span class="label label-success">Approved</span>
                            @elseif ($project->status == 'rejected')
                                <span class="label label-danger">Rejected</span>
                            @endif
                        </div>
                    </div>
                    {{-- Conditionally show Rejection Reason if status is rejected for Admin too --}}
                    @if ($project->status == 'rejected')
                        <div class="project-info-col">
                            <div class="project-section-title">Rejection Reason</div>
                            <div class="project-info-value">
                                {{ $project->rejection_reason ?? 'N/A' }}
                            </div>
                        </div>
                    @endif
                    <div class="project-info-col">
                        <div class="project-section-title">Project Created by</div>
                        <div class="project-info-value">{{ $project->hasCreatedBy->name ?? 'N/A' }} {{ $project->hasCreatedBy->last_name ?? 'N/A' }} <br> {{ $project->hasCreatedBy->role ?? 'N/A' }}</div>
                    </div>
                @endif
            </div>

           
            <div class="project-section">
                <div class="project-section-title">Relevant Documents</div>
                <div class="file-grid" style="margin-top: 15px;">
                    @if($project->document_file && count(json_decode($project->document_file)) > 0)
                        @foreach(json_decode($project->document_file) as $file)
                            @php
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                $fileUrl =asset('/admin/assets/images/documents/' . $file);
                            @endphp
                            <div class="file-item" id="remove-{{ $file }}">
                               {{--  <span class="remove-file" onclick="removeFile('{{ $file }}')" title="Remove">
                                    <i class="fa fa-times"></i>
                                </span> --}}
                                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <a href="{{ $fileUrl }}" target="_blank">
                                        <img src="{{ $fileUrl }}" alt="{{ $file }}" class="file-image">
                                    </a>
                                @elseif($fileExtension == 'pdf')
                                    <a href="{{ $fileUrl }}" target="_blank">
                                        <img src="{{ asset('/admin/assets/icons/pdf-icon.png') }}" alt="PDF" class="file-icon">
                                    </a>
                                @elseif(in_array($fileExtension, ['docx', 'doc']))
                                    <a href="{{ $fileUrl }}" target="_blank">
                                        <img src="{{ asset('/admin/assets/icons/word-icon.png') }}" alt="Word" class="file-icon">
                                    </a>
                                @elseif(in_array($fileExtension, ['xlsx', 'xls']))
                                    <a href="{{ $fileUrl }}" target="_blank">
                                        <img src="{{ asset('/admin/assets/icons/excel-icon.png') }}" alt="Excel" class="file-icon">
                                    </a>
                                @elseif($fileExtension == 'zip')
                                    <a href="{{ $fileUrl }}" target="_blank">
                                        <img src="{{ asset('/admin/assets/icons/zip-icon.png') }}" alt="Zip" class="file-icon">
                                    </a>
                                @else
                                    <a href="{{ $fileUrl }}" target="_blank">
                                        <img src="{{ asset('/admin/assets/icons/file-icon.png') }}" alt="File" class="file-icon">
                                    </a>
                                @endif
                                <div class="file-name">{{ $file }}</div>
                                <input type="hidden" name="existing_files[]" value="{{ $file }}">
                            </div>
                        @endforeach
                    @else
                        <div class="project-info-value">N/A</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
