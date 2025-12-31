@extends('layouts.trainer.app')

@push('css')
<style>
    :root {
        --fit-primary: #004274;
        --fit-secondary: #0079d4;
        --fit-ink: #0f1720;
        --fit-muted: #6c7a88;
        --fit-border: #e5eaf0;
        --fit-card: #ffffff;
        --fit-shadow: 0 20px 40px rgba(0, 66, 116, 0.12);
    }
    .profile-edit-page {
        max-width: 1100px;
        margin: 0 auto;
    }
    .glass-stage {
        position: relative;
        padding: 26px;
        border-radius: 24px;
        background: linear-gradient(160deg, rgba(0, 121, 212, 0.12), rgba(0, 66, 116, 0.08));
        overflow: hidden;
    }
    .glass-stage::before,
    .glass-stage::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0, 121, 212, 0.35), transparent 70%);
        opacity: 0.7;
        pointer-events: none;
    }
    .glass-stage::before {
        width: 320px;
        height: 320px;
        top: -120px;
        left: -80px;
    }
    .glass-stage::after {
        width: 260px;
        height: 260px;
        bottom: -120px;
        right: -60px;
        background: radial-gradient(circle, rgba(0, 66, 116, 0.35), transparent 70%);
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
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 18px 30px rgba(0, 66, 116, 0.2);
    }
    .glass-hero h2 {
        margin: 0;
        font-weight: 700;
        letter-spacing: -0.02em;
    }
    .glass-hero p {
        margin: 6px 0 0;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.85);
    }
    .glass-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.28);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }
    .glass-avatar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
    }
    .glass-avatar img {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, 0.7);
        background: #0b1c2a;
    }
    .glass-avatar__name {
        font-weight: 600;
    }
    .glass-avatar__meta {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.75);
    }
    .glass-card {
        margin-top: 20px;
        padding: 24px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 18px 34px rgba(0, 66, 116, 0.12);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        position: relative;
        z-index: 1;
    }
    .glass-card__title {
        font-weight: 700;
        margin: 0 0 12px;
        color: var(--fit-ink);
    }
    .glass-grid {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 18px;
    }
    .glass-panel {
        padding: 16px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(0, 121, 212, 0.12);
    }
    .profile-form .form-label {
        font-weight: 700;
        font-size: 11px;
        color: #5b6773;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }
    .profile-form .form-control {
        border-radius: 12px;
        border-color: var(--fit-border);
        background: #f7f9fc;
        height: 44px;
    }
    .profile-form .form-control:focus {
        border-color: var(--fit-secondary);
        box-shadow: 0 0 0 0.2rem rgba(0, 121, 212, 0.2);
        background: #fff;
    }
    .profile-divider {
        margin: 20px 0 16px;
        border-top: 1px solid var(--fit-border);
    }
    .profile-section-title {
        font-weight: 700;
        margin: 14px 0 10px;
        color: var(--fit-ink);
    }
    .profile-actions {
        gap: 12px;
    }
    .profile-actions .btn {
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 700;
        letter-spacing: 0.01em;
    }
    .profile-actions .btn-primary {
        background: linear-gradient(135deg, var(--fit-primary), var(--fit-secondary));
        border: 0;
        box-shadow: 0 12px 20px rgba(0, 66, 116, 0.28);
    }
    .profile-actions .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 24px rgba(0, 66, 116, 0.32);
    }
    .profile-actions .btn-default {
        border: 1px solid var(--fit-border);
        background: #fff;
        color: #1b232c;
    }
    .profile-note {
        color: var(--fit-muted);
        font-size: 12px;
        margin-top: 6px;
    }
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .profile-grid .full {
        grid-column: 1 / -1;
    }
    .profile-avatar-upload {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 10px 10px;
        border-radius: 14px;
        background: rgba(0, 121, 212, 0.08);
        border: 1px solid rgba(0, 121, 212, 0.12);
        margin-bottom: 10px;
    }
    .profile-avatar {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 60px;
        overflow: hidden;
        border: 1px solid rgba(0, 121, 212, 0.2);
        box-shadow: 0 8px 16px rgba(0, 66, 116, 0.16);
        background: #0b1c2a;
        flex-shrink: 0;
    }
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .profile-avatar-button {
        position: absolute;
        right: -6px;
        bottom: -6px;
        width: 24px;
        height: 24px;
        border-radius: 10px;
        background: var(--fit-secondary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 12px rgba(0, 121, 212, 0.4);
        cursor: pointer;
        border: 2px solid #fff;
        font-size: 11px;
    }
    .profile-file-input {
        position: absolute;
        left: -9999px;
    }
    .profile-avatar-title {
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #3a4a5b;
        margin-bottom: 2px;
    }
    .profile-avatar-actions {
        display: flex;
        gap: 8px;
        margin-top: 6px;
    }
    .profile-avatar-actions .btn {
        padding: 5px 10px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 12px;
    }
    .profile-avatar-actions .btn-outline {
        border: 1px solid rgba(0, 121, 212, 0.35);
        color: var(--fit-secondary);
        background: #fff;
    }
    .password-toggle {
        background: #f7f9fc;
        border: 1px solid var(--fit-border);
        border-left: 0;
        cursor: pointer;
    }
    .password-toggle i {
        color: #6c7a88;
    }
    @media (max-width: 991px) {
        .glass-hero {
            flex-direction: column;
            align-items: flex-start;
        }
        .glass-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 767px) {
        .glass-stage {
            padding: 18px;
        }
        .glass-card {
            padding: 18px;
        }
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <div class="container profile-edit-page">
        <div class="row">
            <div class="col-md-12">
                <div class="glass-stage">
                    <div class="glass-hero">
                        <div>
                            <div class="glass-badge">{{ $user->getRoleNames()->first() }}</div>
                            <h2>Edit Profile</h2>
                            <p>Keep your account fresh and ready for bookings.</p>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="profile-note" data-profile-success="{{ session('success') }}"></div>
                    @endif

                    <div class="glass-card">
                        <form class="profile-form" action="{{ route('trainer.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="glass-grid">
                                <div class="glass-panel">
                                    <h5 class="glass-card__title">Profile Details</h5>
                                    <div class="mb-3">
                                        <div class="profile-avatar-upload">
                                            <div class="profile-avatar">
                                                @if ($user->image)
                                                    <img id="profileAvatarPreview" src="{{ asset('admin/assets/images/UserImage/' . $user->image) }}" alt="Profile Image">
                                                @else
                                                    <img id="profileAvatarPreview" src="https://via.placeholder.com/80" alt="Default Profile Image">
                                                @endif
                                            </div>
                                            <div>
                                                <div class="profile-avatar-title">Profile Photo</div>
                                                <div class="profile-note">JPG/PNG/GIF · Up to 2MB</div>
                                                <div class="profile-avatar-actions">
                                                    <label class="btn btn-outline" for="image">Upload new</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="file" class="profile-file-input @error('image') is-invalid @enderror"
                                            id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="profile-grid">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="glass-panel">
                                    <h5 class="glass-card__title">Security</h5>
                                    <hr class="profile-divider">
                                    <h5 class="profile-section-title">Change Password <small class="text-muted">(Leave blank to keep current password)</small></h5>

                                    <div class="profile-grid">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">New Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password">
                                                <span class="input-group-addon password-toggle" data-target="#password" role="button" aria-label="Toggle password visibility">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation">
                                                <span class="input-group-addon password-toggle" data-target="#password_confirmation" role="button" aria-label="Toggle password visibility">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between profile-actions" style="margin-top: 16px;">
                                <a href="{{ route('trainer.dashboard') }}" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    (function () {
        'use strict';
        var fileInput = document.getElementById('image');
        var preview = document.getElementById('profileAvatarPreview');
        if (fileInput && preview) {
            fileInput.addEventListener('change', function () {
                if (!fileInput.files || !fileInput.files[0]) {
                    return;
                }
                var url = URL.createObjectURL(fileInput.files[0]);
                preview.src = url;
                preview.onload = function () {
                    URL.revokeObjectURL(url);
                };
            });
        }
        var successNode = document.querySelector('[data-profile-success]');
        if (successNode && window.Swal) {
            Swal.fire({
                icon: 'success',
                title: 'Profile updated',
                text: successNode.getAttribute('data-profile-success'),
                confirmButtonColor: '#0079d4'
            });
        }
        document.querySelectorAll('.password-toggle').forEach(function (toggle) {
            toggle.addEventListener('click', function () {
                var target = document.querySelector(toggle.getAttribute('data-target'));
                if (!target) {
                    return;
                }
                var icon = toggle.querySelector('i');
                if (target.type === 'password') {
                    target.type = 'text';
                    if (icon) {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                } else {
                    target.type = 'password';
                    if (icon) {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                }
            });
        });
    })();
</script>
@endpush
