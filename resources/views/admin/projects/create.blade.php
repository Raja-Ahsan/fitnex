@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.member.app')))
@section('title', $page_title)
@section('content')
<section class="content-header">
    <div class="content-header-left">
        <h1>Add New Project</h1>
    </div>
    <div class="content-header-right">
        <a href="{{ route('projects.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('projects.store') }}" id="invoiceForm" class="form-horizontal" enctype="multipart/form-data" method="post">
                @csrf
                <div class="box box-info">
                    <div class="box-body">
                        <!-- EPC Company Name -->
                        <div class="form-group">
                            <label for="company_name" class="col-sm-2 control-label">EPC Company Name<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" autocomplete="organization" class="form-control" id="company_name" name="company" value="{{ old('company') }}" placeholder="Enter EPC Company name" required>
                                <span style="color: red">{{ $errors->first('company') }}</span>
                            </div>
                        </div>

                        <!-- Project Name -->
                        <div class="form-group">
                            <label for="project_title" class="col-sm-2 control-label">Project Name<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" autocomplete="off" class="form-control" id="project_title" name="name" value="{{ old('name') }}" placeholder="Enter name of project" required>
                                <span style="color: red">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <!-- Project Category -->
                        <div class="form-group">
                            <label for="project_category_id" class="col-sm-2 control-label">Services Needed<span style='color:red'>*</span></label>
                            <div class="col-md-8">
                                <select name="project_category_id[]" id="project_category_id" class="form-control" multiple required autocomplete="off">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ (collect(old('project_category_id'))->contains($category->id)) ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                <span style="color: red">{{ $errors->first('project_category_id') }}</span>
                            </div>
                        </div>

                        <!-- Alliance Area -->
                        <div class="form-group">
                            <label for="county" class="col-sm-2 control-label">Alliance Area<span style="color: red">*</span></label>
                            <div class="col-sm-8">
                                <select name="county[]" id="county" class="form-control" multiple required autocomplete="off">
                                    <option value="Amelia" {{ (collect(old('county'))->contains('Amelia')) ? 'selected' : '' }}>Amelia</option>
                                    <option value="Appomattox" {{ (collect(old('county'))->contains('Appomattox')) ? 'selected' : '' }}>Appomattox</option>
                                    <option value="Brunswick" {{ (collect(old('county'))->contains('Brunswick')) ? 'selected' : '' }}>Brunswick</option>
                                    <option value="Campbell" {{ (collect(old('county'))->contains('Campbell')) ? 'selected' : '' }}>Campbell</option>
                                    <option value="Charlotte" {{ (collect(old('county'))->contains('Charlotte')) ? 'selected' : '' }}>Charlotte</option>
                                    <option value="Chesterfield" {{ (collect(old('county'))->contains('Chesterfield')) ? 'selected' : '' }}>Chesterfield</option>
                                    <option value="Cumberland" {{ (collect(old('county'))->contains('Cumberland')) ? 'selected' : '' }}>Cumberland</option>
                                    <option value="Dinwiddie" {{ (collect(old('county'))->contains('Dinwiddie')) ? 'selected' : '' }}>Dinwiddie</option>
                                    <option value="Fairfax" {{ (collect(old('county'))->contains('Fairfax')) ? 'selected' : '' }}>Fairfax</option>
                                    <option value="Fluvanna" {{ (collect(old('county'))->contains('Fluvanna')) ? 'selected' : '' }}>Fluvanna</option>
                                    <option value="Franklin" {{ (collect(old('county'))->contains('Franklin')) ? 'selected' : '' }}>Franklin</option>
                                    <option value="Greensville" {{ (collect(old('county'))->contains('Greensville')) ? 'selected' : '' }}>Greensville</option>
                                    <option value="Goochland" {{ (collect(old('county'))->contains('Goochland')) ? 'selected' : '' }}>Goochland</option>
                                    <option value="Halifax" {{ (collect(old('county'))->contains('Halifax')) ? 'selected' : '' }}>Halifax</option>
                                    <option value="Henry" {{ (collect(old('county'))->contains('Henry')) ? 'selected' : '' }}>Henry</option>
                                    <option value="Lunenburg" {{ (collect(old('county'))->contains('Lunenburg')) ? 'selected' : '' }}>Lunenburg</option>
                                    <option value="Mecklenburg" {{ (collect(old('county'))->contains('Mecklenburg')) ? 'selected' : '' }}>Mecklenburg</option>
                                    <option value="Nottoway" {{ (collect(old('county'))->contains('Nottoway')) ? 'selected' : '' }}>Nottoway</option>
                                    <option value="Pittsylvania" {{ (collect(old('county'))->contains('Pittsylvania')) ? 'selected' : '' }}>Pittsylvania</option>
                                    <option value="Powhatan" {{ (collect(old('county'))->contains('Powhatan')) ? 'selected' : '' }}>Powhatan</option>
                                    <option value="Prince Edward" {{ (collect(old('county'))->contains('Prince Edward')) ? 'selected' : '' }}>Prince Edward</option>
                                    <option value="Spotsylvania" {{ (collect(old('county'))->contains('Spotsylvania')) ? 'selected' : '' }}>Spotsylvania</option>
                                    <option value="Stafford" {{ (collect(old('county'))->contains('Stafford')) ? 'selected' : '' }}>Stafford</option>
                                </select>
                                <span style="color: red">{{ $errors->first('county') }}</span>
                            </div>
                        </div>

                        <!-- Project Image -->
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Add Image for Hub Listing 
                                (Logo, Site, POC, etc.) <span style="color: red">*</span></label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" class="form-control" accept="image*"  name="image" id="image" required>
								<span style="color: red">{{ $errors->first('image') }}</span>
							</div>
							<div class="col-sm-4" >
								<img style="width: 80px" id="banner_preview"  src="{{asset('/admin/assets/images/default.jpg') }}"  alt="Image Not Found ">
							</div>
						</div>
                            
                        <!-- Estimated Start Date -->
                        <div class="form-group">
                            <label for="start_date" class="col-sm-2 control-label">Estimated Start Date <span style='color:red'>*</span></label>
                            <div class="col-sm-4">
                                <input type="date" class="start-date form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required autocomplete="off">
                                <span style="color: red">{{ $errors->first('start_date') }}</span>
                            </div>

                            <!-- Estimated End Date -->
                            <label for="end_date" class="col-sm-1 control-label">Estimated End Date</label>
                            <div class="col-sm-3">
                                <input type="date" class="end-date form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" autocomplete="off">
                                <span style="color: red">{{ $errors->first('end_date') }}</span>
                            </div>
                        </div>

                        <!-- Project Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Project Description<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <textarea name="description" id="description" class="form-control" placeholder="Enter project description" required autocomplete="off">{{ old('description') }}</textarea>
                                <span style="color: red">{{ $errors->first('description') }}</span>
                            </div>
                        </div>

                        <!-- Project POC Name -->
                        <div class="form-group">
                            <label for="poc_name" class="col-sm-2 control-label">Project POC Name<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="poc_name" name="poc_name" placeholder="Enter POC Name" required value="{{ old('poc_name') }}" autocomplete="name">
                                <span style="color: red">{{ $errors->first('poc_name') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="poc_phone" class="col-sm-2 control-label">Project POC Phone<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="tel" class="form-control" id="poc_phone" name="poc_phone" placeholder="Enter POC Phone" required value="{{ old('poc_phone') }}" autocomplete="tel">
                                <span style="color: red">{{ $errors->first('poc_phone') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="poc_email" class="col-sm-2 control-label">Project POC Email<span style='color:red'>*</span></label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="poc_email" name="poc_email" placeholder="Enter POC Email" required value="{{ old('poc_email') }}" autocomplete="email">
                                <span style="color: red">{{ $errors->first('poc_email') }}</span>
                            </div>
                        </div>

                        <!-- Key Links -->
                        <div class="form-group">
                            <label for="key_links" class="col-sm-2 control-label">Key Links</label>
                            <div class="col-sm-6">
                                <div id="key_links_container">
                                    @if (old('key_links'))
                                        @foreach (json_decode(old('key_links'), true) as $index => $link)
                                            <div class="key-link-item row align-items-center mb-3">
                                                <div class="col-sm-5">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Add Link</span>
                                                        </div>
                                                        <input type="url" class="form-control" name="key_links[{{ $index }}][url]" placeholder="http://www.example.com" value="{{ $link['url'] ?? '' }}" autocomplete="url">
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Link Label</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="key_links[{{ $index }}][label]" placeholder="Info Portal" value="{{ $link['label'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-danger remove-key-link" type="button">Remove</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="key-link-item row align-items-center mb-3" id="key_link_template" style="{{ old('key_links') ? 'display: none;' : '' }}">
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Add Link</span>
                                                </div>
                                                <input type="url" class="form-control" name="key_links[0][url]" placeholder="http://www.example.com" value="{{ old('key_links.0.url') }}" autocomplete="url">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Link Label</span>
                                                </div>
                                                <input type="text" class="form-control" name="key_links[0][label]" placeholder="Info Portal" value="{{ old('key_links.0.label') }}">
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

                        <!-- Relevant Documents -->
                        <div class="form-group">
                            <label for="document_file" class="col-sm-2 control-label">Relevant Documents</label>
                            <div class="col-sm-8" style="padding-top:5px">
                                <input type="file" class="form-control" accept="image/*, .pdf, .doc, .docx" name="document_file[]" id="document_file" multiple autocomplete="off">
                                <input type="hidden" name="file_names" id="file_names">
                                <input type="hidden" name="file_sizes" id="file_sizes">
                                <span style="color: red">{{ $errors->first('document_file') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left">Submit</button>
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

        // Image preview
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                banner_preview.src = URL.createObjectURL(file)
            }
        }

        // Document file name display
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

        // Add more Key Links
        let keyLinkIndex = {{ old('key_links') ? count(json_decode(old('key_links'), true)) : 1 }};
        const keyLinksContainer = document.getElementById('key_links_container');
        const keyLinkTemplate = document.getElementById('key_link_template');

        document.querySelector('.add-more-key-link').addEventListener('click', function() {
            const newLinkItem = keyLinkTemplate.cloneNode(true);
            newLinkItem.style.display = 'flex'; // Make sure it's visible
            newLinkItem.removeAttribute('id');
            const urlInput = newLinkItem.querySelector('input[name*="[url]"]');
            const labelInput = newLinkItem.querySelector('input[name*="[label]"]');
            urlInput.name = `key_links[${keyLinkIndex}][url]`;
            urlInput.value = '';
            labelInput.name = `key_links[${keyLinkIndex}][label]`;
            labelInput.value = '';
            newLinkItem.querySelector('.remove-key-link').addEventListener('click', function() {
                const keyLinksContainer = document.getElementById('key_links_container');
                if (keyLinksContainer.querySelectorAll('.key-link-item:not([style*="display: none"])').length > 1) {
                    newLinkItem.remove();
                    toggleRemoveButtons(); // Call after removing
                }
            });
            keyLinksContainer.appendChild(newLinkItem);
            keyLinkIndex++;
            toggleRemoveButtons(); // Call after adding
        });

        // Initial setup for existing remove buttons (if any)
        document.querySelectorAll('.remove-key-link').forEach(button => {
            button.addEventListener('click', function() {
                const keyLinksContainer = document.getElementById('key_links_container');
                if (keyLinksContainer.querySelectorAll('.key-link-item:not([style*="display: none"])').length > 1) {
                    button.closest('.key-link-item').remove();
                    toggleRemoveButtons(); // Call after removing
                }
            });
        });

        // Function to toggle the visibility of remove buttons
        function toggleRemoveButtons() {
            const keyLinkItems = document.querySelectorAll('#key_links_container .key-link-item:not([style*="display: none"])');
            if (keyLinkItems.length === 1) {
                keyLinkItems[0].querySelector('.remove-key-link').style.display = 'none';
            } else {
                keyLinkItems.forEach(item => {
                    item.querySelector('.remove-key-link').style.display = 'block';
                });
            }
        }

        // Call on initial load
        toggleRemoveButtons();
    });
</script>
