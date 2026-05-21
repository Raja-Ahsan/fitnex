@extends('layouts.trainer.app')

@php
    $trainerAttrs = $trainer->getAttributes();
    $selectedSlugs = old('trainer_types', !empty($trainerAttrs['trainer_type']) ? array_filter(explode(',', $trainerAttrs['trainer_type'])) : []);
    $specializations = old('specialization', !empty($trainerAttrs['specialization']) ? (json_decode($trainerAttrs['specialization'], true) ?: []) : []);
    if (empty($specializations)) {
        $specializations = [''];
    }
    $dm = $trainerAttrs['delivery_modes'] ?? null;
    $defOnline = $dm === null || $dm === '' || str_contains((string) $dm, 'online');
    $defInPerson = $dm === null || $dm === '' || str_contains((string) $dm, 'in_person');
@endphp

@push('css')
<style>
    :root {
        --fit-primary: #004274;
        --fit-secondary: #0079d4;
        --fit-ink: #0f1720;
        --fit-muted: #6c7a88;
        --fit-border: #e5eaf0;
    }
    .profile-edit-page { /* max-width: 1100px; */ margin: 0 auto; }
    .glass-stage {
        position: relative;
        padding: 26px;
        border-radius: 24px;
        background: linear-gradient(160deg, rgba(0, 121, 212, 0.12), rgba(0, 66, 116, 0.08));
        overflow: hidden;
    }
    .glass-hero {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 18px 20px;
        border-radius: 18px;
        color: #fff;
        background: linear-gradient(135deg, var(--fit-primary), var(--fit-secondary));
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 18px 30px rgba(0, 66, 116, 0.2);
    }
    .glass-hero h2 { margin: 0; font-weight: 700; }
    .glass-hero p { margin: 6px 0 0; font-size: 13px; color: rgba(255, 255, 255, 0.85); }
    .glass-badge {
        display: inline-flex;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.18);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }
    .glass-card {
        margin-top: 20px;
        padding: 24px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 18px 34px rgba(0, 66, 116, 0.12);
    }
    .glass-card__title {
        font-weight: 700;
        color: var(--fit-primary);
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid rgba(0, 121, 212, 0.15);
    }
    .glass-panel { margin-bottom: 24px; }
    .profile-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px 16px;
    }
    .profile-avatar img {
        width: 80px;
        height: 80px;
        border-radius: 14px;
        object-fit: cover;
    }
    .profile-note { font-size: 12px; color: var(--fit-muted); }
    .profile-file-input { margin-top: 8px; }
    .delivery-checkboxes label { margin-right: 18px; font-weight: 500; }
    .specialization-item { margin-bottom: 10px; }
    @media (max-width: 767px) {
        .profile-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    <div class="profile-edit-page">
        <div class="glass-stage">
            <div class="glass-hero">
                <div>
                    <div class="glass-badge">Coach profile</div>
                    <h2>Edit Profile</h2>
                    <p>Update your account and public coach listing details.</p>
                </div>
            </div>

            @if (session('success'))
                <div class="profile-note" data-profile-success="{{ session('success') }}" style="margin-top:12px;color:#155724;"></div>
            @endif

            <div class="glass-card">
                <form action="{{ route('trainer.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="glass-panel">
                        <h5 class="glass-card__title">Account & photo</h5>
                        <div class="row">
                            <div class="col-sm-3 text-center" style="margin-bottom:16px;">
                                @if ($user->image)
                                    <img id="profileAvatarPreview" src="{{ asset('admin/assets/images/UserImage/' . $user->image) }}" alt="Profile" class="profile-avatar" style="width:80px;height:80px;">
                                @else
                                    <img id="profileAvatarPreview" src="{{ asset('/admin/assets/images/Trainers/no-photo1.jpg') }}" alt="Profile" style="width:80px;height:80px;border-radius:14px;object-fit:cover;">
                                @endif
                                <div class="profile-note" style="margin-top:8px;">Max {{ upload_max_mb() }} MB</div>
                            </div>
                            <div class="col-sm-9">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="profile-grid" style="margin-top:16px;">
                            <div>
                                <label for="name" class="control-label">First name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label for="last_name" class="control-label">Last name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                                @error('last_name')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label for="designation" class="control-label">Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $user->designation) }}" required>
                                @error('designation')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label for="email" class="control-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label for="phone" class="control-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="glass-panel">
                        <h5 class="glass-card__title">Coach listing (saved to your trainer profile)</h5>
                        <div class="form-group">
                            <label for="description">About you <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" rows="4" required placeholder="Tell clients about your experience and approach">{{ old('description', $trainerAttrs['description'] ?? '') }}</textarea>
                            @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Specializations</label>
                            <div id="specialization_container">
                                @foreach ($specializations as $spec)
                                    <div class="input-group specialization-item">
                                        <input type="text" class="form-control" name="specialization[]" value="{{ $spec }}" placeholder="e.g. Weight loss, HIIT">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger remove-specialization" type="button">Remove</button>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-default btn-sm add-more-specialization" style="margin-top:8px;">+ Add specialization</button>
                        </div>

                        <div class="profile-grid">
                            <div class="form-group">
                                <label for="trainer_types">Categories <span class="text-danger">*</span></label>
                                <select name="trainer_types[]" id="trainer_types" class="form-control select2-trainer-categories" multiple required style="width:100%;">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ in_array($category->slug, $selectedSlugs) ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('trainer_types')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Session price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $trainerAttrs['price'] ?? '') }}" placeholder="e.g. 75" required>
                                @error('price')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="city">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" value="{{ old('city', $trainerAttrs['city'] ?? '') }}" required>
                                @error('city')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="state">State <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" name="state" id="state" value="{{ old('state', $trainerAttrs['state'] ?? '') }}" required>
                                @error('state')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group delivery-checkboxes">
                            <label>Session delivery <span class="text-danger">*</span></label>
                            <div>
                                <input type="hidden" name="delivery_online" value="0">
                                <input type="hidden" name="delivery_in_person" value="0">
                                <label><input type="checkbox" name="delivery_online" value="1" {{ old('delivery_online', $defOnline ? '1' : '0') == '1' ? 'checked' : '' }}> Online</label>
                                <label><input type="checkbox" name="delivery_in_person" value="1" {{ old('delivery_in_person', $defInPerson ? '1' : '0') == '1' ? 'checked' : '' }}> In-person</label>
                            </div>
                            @error('delivery_modes')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>

                        <div class="profile-grid">
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="url" class="form-control" name="facebook" value="{{ old('facebook', $user->facebook) }}">
                            </div>
                            <div class="form-group">
                                <label for="twitter">Twitter / X</label>
                                <input type="url" class="form-control" name="twitter" value="{{ old('twitter', $user->twitter) }}">
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="url" class="form-control" name="instagram" value="{{ old('instagram', $user->instagram) }}">
                            </div>
                            <div class="form-group">
                                <label for="linkedin">LinkedIn</label>
                                <input type="url" class="form-control" name="linkedin" value="{{ old('linkedin', $user->linkedin) }}">
                            </div>
                            <div class="form-group">
                                <label for="youtube">YouTube</label>
                                <input type="url" class="form-control" name="youtube" value="{{ old('youtube', $user->youtube) }}">
                            </div>
                        </div>

                        @if(($trainerAttrs['status'] ?? 0) == 0)
                            <p class="profile-note">Your public listing may stay hidden until an admin activates your profile.</p>
                        @endif
                    </div>

                    <div class="glass-panel">
                        <h5 class="glass-card__title">Security</h5>
                        <div class="profile-grid">
                            <div>
                                <label for="password">New password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                                @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label for="password_confirmation">Confirm password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <p class="profile-note">Leave blank to keep your current password.</p>
                    </div>

                    <div class="clearfix" style="margin-top:16px;">
                        <a href="{{ route('trainer.dashboard') }}" class="btn btn-default pull-left">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right">Save profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="specialization_template" style="display:none;">
        <div class="input-group specialization-item">
            <input type="text" class="form-control" name="specialization[]" placeholder="e.g. Weight loss, HIIT">
            <span class="input-group-btn">
                <button class="btn btn-danger remove-specialization" type="button">Remove</button>
            </span>
        </div>
    </div>
@endsection

@push('js')
<script>
(function () {
    var fileInput = document.getElementById('image');
    var preview = document.getElementById('profileAvatarPreview');
    if (fileInput && preview) {
        fileInput.addEventListener('change', function () {
            if (!fileInput.files || !fileInput.files[0]) return;
            preview.src = URL.createObjectURL(fileInput.files[0]);
        });
    }

    if ($.fn.select2) {
        $('.select2-trainer-categories').select2({ width: '100%', placeholder: 'Select categories' });
    }

    function updateRemoveButtons() {
        var items = document.querySelectorAll('#specialization_container .specialization-item');
        items.forEach(function (item) {
            var btn = item.querySelector('.remove-specialization');
            if (btn) btn.style.visibility = items.length > 1 ? 'visible' : 'hidden';
        });
    }

    document.querySelector('.add-more-specialization')?.addEventListener('click', function () {
        var tpl = document.getElementById('specialization_template');
        if (!tpl) return;
        document.getElementById('specialization_container').appendChild(tpl.firstElementChild.cloneNode(true));
        updateRemoveButtons();
    });

    document.getElementById('specialization_container')?.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-specialization')) {
            e.target.closest('.specialization-item').remove();
            updateRemoveButtons();
        }
    });

    updateRemoveButtons();

    var successNode = document.querySelector('[data-profile-success]');
    if (successNode && window.Swal) {
        Swal.fire({
            icon: 'success',
            title: 'Profile updated',
            text: successNode.getAttribute('data-profile-success'),
            confirmButtonColor: '#0079d4'
        });
    }
})();
</script>
@endpush
