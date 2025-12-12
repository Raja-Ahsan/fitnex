@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
<style>
    :root {
        --primary-color: #007bff;
        --primary-color-dark: #0056b3;
        --secondary-color: #6c757d;
        --background-color: #c5c5c5;
        --card-background: #ffffff;
        --text-color: #333;
        --input-border-color: #ced4da;
        --input-focus-color: #80bdff;
        --input-bg-color: #f8f9fa;
        --error-color: #dc3545;
    }
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .signup-section {
        padding: 5rem 1rem;
        background-color: var(--background-color);
    }
    .signup-container {
        max-width: 1000px;
        margin: auto;
        background-color: var(--card-background);
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 2rem 3rem;
        border-top: 5px solid var(--primary-color);
    }
    .form-title {
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
        text-align: center;
        font-size: 2.2rem;
    }
    .form-subtitle {
        text-align: center;
        color: var(--secondary-color);
        margin-bottom: 2.5rem;
    }
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }
    .form-col {
        position: relative;
        width: 100%;
        padding-right: 10px;
        padding-left: 10px;
    }
    .form-col-half {
        flex: 0 0 50%;
        max-width: 50%;
    }
    @media (max-width: 767px) {
        .form-col-half {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    .form-field-group {
        margin-bottom: 1.5rem;
    }
    .field-label {
        display: block;
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: .5rem;
    }
    .input-field {
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--text-color);
        background-color: var(--input-bg-color);
        background-clip: padding-box;
        border: 1px solid var(--input-border-color);
        border-radius: .5rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        box-sizing: border-box;
    }
    .input-field:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        background-color: #fff;
    }
    .input-field.invalid-input {
        border-color: var(--error-color);
    }
    .error-message {
        width: 100%;
        margin-top: .25rem;
        font-size: .875em;
        color: var(--error-color);
    }
    .checkbox-group {
        text-align: center;
        margin-top: 1rem;
        margin-bottom: 1.5rem;
    }
    .checkbox-input {
        margin-right: .5rem;
    }
    .terms-link a {
        color: var(--primary-color);
        text-decoration: none;
    }
    .terms-link a:hover {
        text-decoration: underline;
    }
    .submit-button-container {
        text-align: center;
    }
    .submit-button {
        background-image: linear-gradient(to right, #007bff 0%, #0056b3 51%, #007bff 100%);
        background-size: 200% auto;
        color: white;
        font-weight: 600;
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 50px;
        transition: 0.5s;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
    .submit-button:hover {
        background-position: right center;
    }
    .loading-spinner {
        border: 2px solid rgba(255,255,255,0.3);
        border-top: 2px solid #fff;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        animation: spin 1s linear infinite;
        margin-left: .5rem;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .login-link {
        text-align: center;
        margin-top: 1.5rem;
    }
    .login-link a {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
    }
    .login-link a:hover {
        text-decoration: underline;
    }
    .error-alert {
        background-color: #f8d7da;
        color: #721c24;
        padding: .75rem 1.25rem;
        margin-top: 1.5rem;
        border: 1px solid #f5c6cb;
        border-radius: .25rem;
    }
</style>

<!-- Banner Section -->
<section class="inner-banner listing-banner" style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/'.$banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
    <div class="container">
        <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1]" data-aos="flip-right" data-aos-easing="linear" data-aos-duration="1500">
            @php
                $title = ($banner && $banner->name) ? $banner->name : '';
                $parts = explode(' ', $title, 2);
            @endphp
            <span class="italic uppercase font-black">
                <span class="primary-theme-text">{{ $parts[0] }}</span>@if(isset($parts[1])) {{ $parts[1] }}@endif
            </span>
        </h1>
    </div>
</section>
<!-- Signup Form Section -->
<section class="signup-section" id="signup-form">
    <div class="signup-container" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000">
        <h2 class="form-title"><span>FITNEX Trainer Registration</span></h2>
        <p class="form-subtitle">Join FITNEX as a trainer and start your fitness journey! Registration is free.</p>
        <form method="POST" action="{{ route('user.register.store') }}" id="subscription-form" enctype="multipart/form-data">
            @csrf
            <!-- Hidden field for Trainer role - trainers register for free -->
            <input type="hidden" name="role" value="trainer">
            <input type="hidden" name="amount" value="0">
            
            <div class="form-row">
                <!-- First Name -->
                <div class="form-col form-col-half">
                    <div class="form-field-group">
                        <label for="name" class="field-label">First Name</label>
                        <input type="text" class="input-field @error('name') invalid-input @enderror" name="name" id="name" placeholder="First Name" value="{{ old('name') }}" required>
                        @error('name') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
                <!-- Last Name -->
                <div class="form-col form-col-half">
                    <div class="form-field-group">
                        <label for="last_name" class="field-label">Last Name</label>
                        <input type="text" class="input-field @error('last_name') invalid-input @enderror" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                        @error('last_name') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <!-- Email -->
                <div class="form-col form-col-half">
                    <div class="form-field-group">
                        <label for="email" class="field-label">Email Address</label>
                        <input type="email" class="input-field @error('email') invalid-input @enderror" name="email" id="email" placeholder="john.doe@example.com" value="{{ old('email') }}" required>
                        @error('email') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
                <!-- Phone -->
                <div class="form-col form-col-half">
                    <div class="form-field-group">
                        <label for="phone" class="field-label">Phone Number</label>
                        <input type="text" class="input-field @error('phone') invalid-input @enderror" name="phone" id="phone" placeholder="+1 (555) 123-4567" value="{{ old('phone') }}" required>
                        @error('phone') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <!-- Password -->
            <div class="form-row">
                <div class="form-col form-col-half">
                    <div class="form-field-group">
                        <label for="password" class="field-label">Password</label>
                        <input type="password" class="input-field @error('password') invalid-input @enderror" name="password" id="password" placeholder="Enter a secure password" required>
                        @error('password') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
                <!-- Confirm Password -->
                <div class="form-col form-col-half">
                    <div class="form-field-group">
                        <label for="password_confirmation" class="field-label">Confirm Password</label>
                        <input type="password" class="input-field" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
                    </div>
                </div>
            </div>
            
            <!-- Terms and Conditions -->
            <div class="checkbox-group">
                <input type="checkbox" class="checkbox-input" name="terms" id="Check1" required>
                <label class="checkbox-label terms-link" for="Check1">
                    I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
                </label>
                @error('terms') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <!-- Submit Button -->
            <div class="submit-button-container">
                <button type="submit" class="submit-button" id="register-btn">
                    Register
                    <span id="register-spinner" class="loading-spinner hidden"></span>
                </button>
            </div>
            
            @if($errors->has('error'))
                <div class="error-alert">{{ $errors->first('error') }}</div>
            @endif
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="{{ route('login') }}">Log In</a></p>
        </div>
    </div>
</section>
@endsection


{{-- @if($package->price != 0) --}}
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var elements = stripe.elements();
        var card = elements.create('card');
        // card.mount('#card-element'); // This needs a container if used

        var form = document.getElementById('subscription-form');

        form.addEventListener('submit', function(event) {
            // This is trainer registration only - no Stripe payment needed
            // Skip Stripe processing for trainers
            
            document.getElementById('register-btn').disabled = true;
            document.getElementById('register-spinner').classList.remove('hidden');
        });
    });
</script>
{{-- @else --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('subscription-form').addEventListener('submit', function() {
            document.getElementById('register-btn').disabled = true;
            document.getElementById('register-spinner').classList.remove('hidden');
        });
    });
</script>
{{-- @endif --}}

<!-- Choices.js and other scripts are removed as they are not used -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const errorFields = document.querySelectorAll('.invalid-input');
    errorFields.forEach(function(field) {
        const errorMessage = field.nextElementSibling;
        if (errorMessage && errorMessage.classList.contains('error-message')) {
            errorMessage.style.display = 'block';
        }
    });

    // This form is for trainer registration only - no payment needed
    const form = document.getElementById('subscription-form');
    if (form) {
        // Ensure amount is always 0 for trainer registration
        const amountInput = form.querySelector('input[name="amount"]');
        if (amountInput) {
            amountInput.value = '0';
        }
    }
});
</script>



