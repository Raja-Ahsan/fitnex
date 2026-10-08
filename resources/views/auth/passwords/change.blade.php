@extends('layouts.website.master')
@section('title', $page_title ?? 'Reset Password')

@push('styles')
@include('auth.partials.auth-card-styles')
@endpush

@section('content')
    <section class="login-page">
        <div class="login-page__inner">
            <div class="log-forms">
                <div class="login-page__brand" aria-label="FITNEX">
                    <span class="login-page__brand-fit">FIT</span><span class="login-page__brand-nex">NEX</span>
                </div>

                <div class="auth-icon" aria-hidden="true"><i class="fa-solid fa-lock"></i></div>

                <h1 class="login-page__title">Set a new password</h1>
                <p class="login-page__subtitle">Choose a password you'll remember. You'll use it to log in to FITNEX.</p>

                @if (Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif

                <form method="POST" action="{{ route('password.change') }}" id="change-form">
                    @csrf
                    <input type="hidden" name="verify_token" value="{{ $verify_token }}">

                    <div class="form-group field-wrap">
                        <label class="login-label" for="new-password">New password</label>
                        <div class="input-wrap">
                            <input class="input-field" id="new-password" name="password" type="password"
                                placeholder="Enter a new password" required autocomplete="new-password" autofocus>
                            <button type="button" class="input-icon input-icon--toggle" data-toggle-for="new-password" aria-label="Show password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        <span class="field-error">{{ $errors->first('password') }}</span>
                    </div>

                    <div class="form-group field-wrap">
                        <label class="login-label" for="confirm-password">Confirm password</label>
                        <div class="input-wrap">
                            <input class="input-field" id="confirm-password" name="confirm-password" type="password"
                                placeholder="Re-enter your new password" required autocomplete="new-password">
                            <button type="button" class="input-icon input-icon--toggle" data-toggle-for="confirm-password" aria-label="Show password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        <span class="auth-hint" id="match-hint"></span>
                        <span class="field-error">{{ $errors->first('confirm-password') }}</span>
                    </div>

                    <button type="submit" class="btn btn-continue" id="change-submit">Save new password</button>
                </form>

                <hr class="form-divider">

                <div class="form-under-btn">
                    <a href="{{ route('login') }}" class="auth-back"><i class="fa-solid fa-arrow-left"></i> Back to login</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-toggle-for]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.getAttribute('data-toggle-for'));
                var icon = btn.querySelector('i');
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                icon.classList.toggle('fa-eye', !show);
                icon.classList.toggle('fa-eye-slash', show);
                btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            });
        });

        var pass = document.getElementById('new-password');
        var confirm = document.getElementById('confirm-password');
        var hint = document.getElementById('match-hint');

        function checkMatch() {
            hint.classList.remove('is-ok', 'is-bad');
            if (!confirm.value) {
                hint.textContent = '';
                return true;
            }
            var ok = pass.value === confirm.value;
            hint.textContent = ok ? 'Passwords match' : 'Passwords do not match';
            hint.classList.add(ok ? 'is-ok' : 'is-bad');
            return ok;
        }

        pass.addEventListener('input', checkMatch);
        confirm.addEventListener('input', checkMatch);

        document.getElementById('change-form').addEventListener('submit', function (e) {
            if (!checkMatch()) {
                e.preventDefault();
                confirm.focus();
                return;
            }
            var btn = document.getElementById('change-submit');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Saving...';
        });
    });
</script>
@endsection
