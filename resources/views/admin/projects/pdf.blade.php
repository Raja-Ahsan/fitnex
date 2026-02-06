<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            background: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .project-card {
            max-width: 900px;
            margin: 30px auto;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            background: #fff;
            padding: 0;
            border: 1px solid #e5e7eb;
        }
        .project-header {
            background: #cb8900;
            border-radius: 18px 18px 0 0;
            padding: 28px 24px 16px 24px;
            text-align: center;
            color: #fff;
        }
        .project-header img {
            width: 120px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .project-header h2 {
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 0;
            font-size: 2.2rem;
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
            font-size: 1.1rem;
        }
        .project-info-value {
            color: #475569;
            font-size: 1rem;
            margin-top: 2px;
        }
        .project-section {
            padding: 0 24px 18px 24px;
        }
        .project-section-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 6px;
            font-size: 1.1rem;
        }
        .label {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
        }
        .label-warning { background: #ffe082; color: #ad6800; }
        .label-success { background: #c8e6c9; color: #256029; }
        .label-danger { background: #ffcdd2; color: #b71c1c; }
        .file-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 12px;
        }
        .file-item {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #f9fafb;
            width: 140px;
            min-height: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 6px 8px 6px;
            margin-bottom: 8px;
        }
        .file-name {
            font-size: 12px;
            color: #334155;
            margin-top: 6px;
            word-break: break-all;
            text-align: center;
            font-weight: 500;
        }
        /* For PDF, images may not render from external URLs, so use only local assets */
        .file-icon, .file-image {
            width: 40px;
            height: 40px;
            margin-bottom: 6px;
            object-fit: contain;
            border-radius: 4px;
        }
        /* Responsive for PDF (limited support) */
        @media (max-width: 600px) {
            .project-card { max-width: 98vw; }
            .project-info-row, .project-section { padding: 12px 4px 0 4px; }
            .project-section { padding-bottom: 8px; }
        }
    </style>
</head>

<body>
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
            @if(Auth::user()->hasRole('Admin'))
            <div class="project-info-col">
                <div class="project-section-title">Project Created by</div>
                <div class="project-info-value">
                    {{ $project->hasCreatedBy->name ?? 'N/A' }} {{ $project->hasCreatedBy->last_name ?? 'N/A' }}<br>
                    {{ $project->hasCreatedBy->role ?? 'N/A' }}
                </div>
            </div>
            @endif
        </div>
        <div class="project-section">
            <div class="project-section-title">Relevant Documents</div>
            <div class="file-grid">
                @if($project->document_file && count(json_decode($project->document_file)) > 0)
                    @foreach(json_decode($project->document_file) as $file)
                        @php
                            $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            $fileType = '';
                            if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) $fileType = 'Image';
                            elseif($fileExtension == 'pdf') $fileType = 'PDF';
                            elseif(in_array($fileExtension, ['docx', 'doc'])) $fileType = 'Word';
                            elseif(in_array($fileExtension, ['xlsx', 'xls'])) $fileType = 'Excel';
                            elseif($fileExtension == 'zip') $fileType = 'Zip';
                            else $fileType = strtoupper($fileExtension);
                        @endphp
                        <div class="file-item">
                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('/admin/assets/images/documents/' . $file) }}" alt="{{ $file }}" class="file-image">
                            @elseif($fileExtension == 'pdf')
                                <img src="{{ asset('/admin/assets/icons/pdf-icon.png') }}" alt="PDF" class="file-icon">
                            @elseif(in_array($fileExtension, ['docx', 'doc']))
                                <img src="{{ asset('/admin/assets/icons/word-icon.png') }}" alt="Word" class="file-icon">
                            @elseif(in_array($fileExtension, ['xlsx', 'xls']))
                                <img src="{{ asset('/admin/assets/icons/excel-icon.png') }}" alt="Excel" class="file-icon">
                            @elseif($fileExtension == 'zip')
                                <img src="{{ asset('/admin/assets/icons/zip-icon.png') }}" alt="Zip" class="file-icon">
                            @else
                                <img src="{{ asset('/admin/assets/icons/file-icon.png') }}" alt="File" class="file-icon">
                            @endif
                            <div class="file-name" style="max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $file }}</div>
                            <div style="font-size: 11px; color: #888; margin-top: 2px;">{{ $fileType }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="project-info-value">N/A</div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>