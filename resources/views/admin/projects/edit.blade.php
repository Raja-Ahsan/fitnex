@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.member.app')))
@section('title', $page_title)
@section('content')
<style>
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
</style>
<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Project Data</h1>
    </div>
    <div class="content-header-right">
        <a href="{{ route('projects.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <form action="{{ route('projects.update', $project->id) }}" id="invoiceForm" class="form-horizontal" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                <div class="box box-info">
                    <div class="box-body">
                        <!-- Project Category (Multiple) -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">EPC Company Name<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" autocomplete="off" class="form-control" name="company" value="{{ old('company', $project->company) }}" placeholder="Enter EPC Company name" required>
                                <span style="color: red">{{ $errors->first('company') }}</span>
                            </div>
                        </div>
                        <!-- Project Name -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project Name<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" autocomplete="off" class="form-control" name="name" value="{{ old('name', $project->name) }}" placeholder="Enter name of project" required>
                                <span style="color: red">{{ $errors->first('name') }}</span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project Category<span style='color:red'>*</span></label>
                            <div class="col-md-8">
                                @php
                                    $selectedCategories = is_array(json_decode($project->project_category_id, true)) ? json_decode($project->project_category_id, true) : [];
                                @endphp
                                <select name="project_category_id[]" id="project_category_id" class="form-control" multiple required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                <span style="color: red">{{ $errors->first('project_category_id') }}</span>
                            </div>
                        </div>
                        <!-- Company -->
                        <!-- Start Date and End Date -->
                        <div class="form-group">
                            <label for="county" class="col-sm-2 control-label">Alliance Area<span style="color: red">*</span></label>
                            <div class="col-sm-8">
                                @php
                                    $allCounties = ['Amelia', 'Nottoway', 'Goochland', 'Halifax', 'Charlotte', 'Pittsylvania', 'Stafford', 'Spotsylvania', 'Powhatan', 'Fluvanna', 'Henry', 'Franklin', 'Greensville', 'Mecklenburg', 'Lunenburg', 'Prince Edward', 'Chesterfield', 'Dinwiddie', 'Brunswick', 'Appomattox', 'Campbell', 'Cumberland', 'Fairfax'];
                                    $selectedCounties = is_array(json_decode($project->county, true)) ? json_decode($project->county, true) : [];
                                @endphp
                                <select name="county[]" id="county" class="form-control" multiple required>
                                    @foreach($allCounties as $county)
                                        <option value="{{ $county }}" {{ in_array($county, $selectedCounties) ? 'selected' : '' }}>{{ $county }}</option>
                                    @endforeach
                                </select>
                                <span style="color: red">{{ $errors->first('county') }}</span>
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project Image<span
                                    style="color:red">*</span></label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" class="form-control" accept="image/*" name="image"
                                    id="image">
                                <span style="color: red">{{ $errors->first('image') }}</span>
                            </div>
                            <div class="col-sm-4">
                                <img style="width: 80px" id="banner_preview"
                                    src="{{ !empty($project->image) ?asset('/admin/assets/images/projects/' . $project->image) :asset('/admin/assets/images/default.jpg') }}"
                                    alt="Image Preview">
                            </div>
                        </div>
                        <!-- Start Date and End Date -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Estimated Start Date <span style='color:red'>*</span></label>
                            <div class="col-sm-4">
                                <input type="date" class="start-date form-control" name="start_date" value="{{ old('start_date', $project->start_date) }}" required>
                                <span style="color: red">{{ $errors->first('start_date') }}</span>
                            </div>

                            <label for="" class="col-sm-1 control-label">Estimated End Date</label>
                            <div class="col-sm-3">
                                <input type="date" class="end-date form-control" name="end_date" value="{{ old('end_date', $project->end_date) }}">
                                <span style="color: red">{{ $errors->first('end_date') }}</span>
                            </div>
                        </div> 
                        <!-- County Dropdown -->
                        <!-- Description -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project Description<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <textarea name="description" class="form-control" placeholder="Enter project description" required>{{ old('description', $project->description) }}</textarea>
                                <span style="color: red">{{ $errors->first('description') }}</span>
                            </div>
                        </div> 
                        <!-- Project POC Name -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project POC Name<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="poc_name" placeholder="Enter POC Name" required value="{{ old('poc_name', $project->poc_name) }}">
                                <span style="color: red">{{ $errors->first('poc_name') }}</span>
                            </div>
                        </div>
                        <!-- Project POC Phone -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project POC Phone<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="poc_phone" placeholder="Enter POC Phone" required value="{{ old('poc_phone', $project->poc_phone) }}">
                                <span style="color: red">{{ $errors->first('poc_phone') }}</span>
                            </div>
                        </div>
                        <!-- Project POC Email -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Project POC Email<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="poc_email" placeholder="Enter POC Email" required value="{{ old('poc_email', $project->poc_email) }}">
                                <span style="color: red">{{ $errors->first('poc_email') }}</span>
                            </div>
                        </div>
                        <!-- Key Links -->
                        <div class="form-group">
                            <label for="key_links" class="col-sm-2 control-label">Key Links</label>
                            <div class="col-sm-6">
                                <div id="key_links_container">
                                    @php
                                        $existingKeyLinks = old('key_links') ? json_decode(json_encode(old('key_links')), true) : (json_decode($project->key_links, true) ?? []);
                                    @endphp
                        
                                    @foreach ($existingKeyLinks as $index => $link)
                                        <div class="key-link-item row align-items-center mb-3">
                                            <div class="col-sm-5">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Add Link</span>
                                                    </div>
                                                    <input type="url" class="form-control" name="key_links[{{ $loop->index }}][url]" placeholder="http://www.example.com" value="{{ $link['url'] ?? '' }}" autocomplete="url">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Link Label</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="key_links[{{ $loop->index }}][label]" placeholder="Info Portal" value="{{ $link['label'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-danger remove-key-link" type="button">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                        
                                    <div class="key-link-item row align-items-center mb-3" id="key_link_template" style="display: none;">
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Add Link</span>
                                                </div>
                                                <input type="url" class="form-control" data-name="url" placeholder="http://www.example.com" value="" autocomplete="url">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Link Label</span>
                                                </div>
                                                <input type="text" class="form-control" data-name="label" placeholder="Info Portal" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-danger remove-key-link" type="button">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <span style="color: red">{{ $errors->first('key_links') }}</span>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-info add-more-key-link pull-right">Add Link</button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Relevant Documents</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" accept="image*, .pdf, .doc, .docx" name="document_file[]" id="document_file" multiple>
                                <input type="hidden" name="file_names" id="file_names">
                                <input type="hidden" name="file_sizes" id="file_sizes">
                                <span style="color: red">{{ $errors->first('document_file') }}</span>
                                <div class="file-grid" style="margin-top: 15px;">
                                    @if($project->document_file && count(json_decode($project->document_file)) > 0)
                                        @foreach(json_decode($project->document_file) as $file)
                                            @php
                                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                $fileUrl =asset('/admin/assets/images/documents/' . $file);
                                            @endphp
                                            <div class="file-item" id="remove-{{ $file }}">
                                                <span class="remove-file" onclick="removeFile('{{ $file }}')" title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </span>
                                               
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
                                                <div style="font-size:12px;word-break:break-all;">{{ $file }}</div>
                                                <input type="hidden" name="existing_files[]" value="{{ $file }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @if(Auth::user()->hasRole('Admin'))
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control" id="status">
                                    <option value="pending" {{ $project->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $project->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $project->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="rejection-reason-group" style="display: {{ $project->status == 'rejected' ? 'block' : 'none' }};">
                            <label for="rejection_reason" class="col-sm-2 control-label">Rejection Reason</label>
                            <div class="col-sm-8">
                                <textarea name="rejection_reason" id="rejection_reason" class="form-control" rows="3">{{ old('rejection_reason', $project->rejection_reason ?? '') }}</textarea>
                            </div>
                        </div>
                        @endif
                        <!-- Relevant Documents -->
                       
                        <!-- Submit Button -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


@endsection
@push('js')
<!-- Include Choices.js -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Choices.js for multiple select fields
        const projectCategorySelect = new Choices('#project_category_id', {
            removeItemButton: true,
        });

        const countySelect = new Choices('#county', {
            removeItemButton: true,
        });

        // Document file name and size hidden fields
        document.getElementById('document_file').addEventListener('change', function(evt) {
            const files = evt.target.files;
            let names = [];
            let sizes = [];
            for (let i = 0; i < files.length; i++) {
                names.push(files[i].name);
                sizes.push(files[i].size);
            }
            document.getElementById('file_names').value = JSON.stringify(names);
            document.getElementById('file_sizes').value = JSON.stringify(sizes);
        });
    });

    function removeFile(fileName) {
        document.getElementById('remove-' + fileName).style.display = 'none';
        document.querySelector('input[name="existing_files[]"][value="' + fileName + '"]').remove();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var statusSelect = document.getElementById('status');
        var reasonGroup = document.getElementById('rejection-reason-group');
        statusSelect.addEventListener('change', function() {
            if (this.value === 'rejected') {
                reasonGroup.style.display = 'block';
            } else {
                reasonGroup.style.display = 'none';
            }
        });
    });
    
    // Key Links
    let keyLinkIndex = {{ count($existingKeyLinks) }};
    const keyLinksContainer = document.getElementById('key_links_container');
    const keyLinkTemplate = document.getElementById('key_link_template');

    document.querySelector('.add-more-key-link').addEventListener('click', function () {
        const newLinkItem = keyLinkTemplate.cloneNode(true);
        newLinkItem.style.display = 'flex';
        newLinkItem.removeAttribute('id');

        const urlInput = newLinkItem.querySelector('input[data-name="url"]');
        const labelInput = newLinkItem.querySelector('input[data-name="label"]');

        urlInput.name = `key_links[${keyLinkIndex}][url]`;
        labelInput.name = `key_links[${keyLinkIndex}][label]`;

        urlInput.value = '';
        labelInput.value = '';

        newLinkItem.querySelector('.remove-key-link').addEventListener('click', function () {
            newLinkItem.remove();
            toggleRemoveButtons();
        });

        keyLinksContainer.appendChild(newLinkItem);
        keyLinkIndex++;
        toggleRemoveButtons();
    });

    document.querySelectorAll('.remove-key-link').forEach(button => {
        button.addEventListener('click', function () {
            const item = this.closest('.key-link-item');
            item.remove();
            toggleRemoveButtons();
        });
    });

    function toggleRemoveButtons() {
        const visibleItems = document.querySelectorAll('#key_links_container .key-link-item');
        visibleItems.forEach(item => {
            item.querySelector('.remove-key-link').style.display = 'block';
        });
    }

    toggleRemoveButtons();

</script>
@endpush