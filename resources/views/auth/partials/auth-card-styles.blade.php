<style>
    .login-page {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 16px 64px;
        background: #000;
    }

    .login-page__inner {
        width: 100%;
        max-width: 420px;
        margin: 0 auto;
    }

    .log-forms {
        padding: 36px 32px 28px;
        border-radius: 16px;
        background: #121212;
        border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .login-page__brand {
        text-align: center;
        margin-bottom: 28px;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
        font-size: 1.75rem;
        font-weight: 800;
        font-style: italic;
        letter-spacing: 0.02em;
        line-height: 1;
    }

    .login-page__brand-fit {
        color: #0079D4;
    }

    .login-page__brand-nex {
        color: #fff;
    }

    .login-page__title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 8px;
        line-height: 1.2;
        text-align: center;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page__subtitle {
        margin: 0 0 28px;
        text-align: center;
        color: #a0a0a0;
        font-size: 0.95rem;
        line-height: 1.5;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #fff;
        margin-bottom: 8px;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page .input-wrap {
        position: relative;
    }

    .login-page .input-field {
        width: 100%;
        border: 1px solid transparent;
        border-radius: 10px;
        padding: 14px 44px 14px 14px;
        background: #1e1e1e;
        color: #fff;
        font-size: 0.95rem;
        margin-bottom: 4px;
        box-sizing: border-box;
    }

    .login-page .input-field::placeholder {
        color: #6b6b6b;
    }

    .login-page .input-field:focus {
        outline: none;
        border-color: #0079D4;
        box-shadow: 0 0 0 3px rgba(0, 121, 212, 0.2);
    }

    .login-page .input-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0a0a0;
        font-size: 0.95rem;
        pointer-events: none;
    }

    .login-page .input-icon--toggle {
        pointer-events: auto;
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        line-height: 1;
    }

    .login-page .input-icon--toggle:hover {
        color: #fff;
    }

    .login-page .field-wrap {
        margin-bottom: 18px;
    }

    .login-page .forgot-row {
        text-align: right;
        margin: -4px 0 20px;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page .forgot-row a {
        color: #0079D4;
        font-size: 0.875rem;
        text-decoration: none;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page .forgot-row a:hover {
        text-decoration: underline;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page .btn-continue {
        width: 100%;
        background-color: #0079D4;
        border: none;
        border-radius: 10px;
        padding: 14px 0;
        font-weight: 700;
        font-size: 1rem;
        color: #fff;
        transition: background-color 0.2s;
        margin-top: 4px;
    }

    .login-page .btn-continue:hover {
        background-color: #0066b8;
        color: #fff;
    }

    .login-page .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 16px;
    }

    .login-page .form-check-input {
        width: 16px;
        height: 16px;
        margin: 0;
        accent-color: #0079D4;
        background-color: #1e1e1e;
        border-color: #3a3a3a;
    }

    .login-page .form-check-label {
        color: #fff;
        font-size: 0.9rem;
        margin: 0;
        cursor: pointer;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page .form-divider {
        border: 0;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        margin: 24px 0 20px;
    }

    .login-page .form-under-btn {
        text-align: center;
        font-size: 0.9rem;
        color: #a0a0a0;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page .form-under-btn a {
        color: #0079D4;
        font-weight: 600;
        text-decoration: none;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page .form-under-btn a:hover {
        text-decoration: underline;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-page .alert {
        border-radius: 12px;
        font-size: 0.875rem;
        line-height: 1.5;
        margin: 0 0 16px;
        padding: 14px 18px;
        border: none;
        text-align: center;
    }

    .login-page .alert-danger {
        background: rgba(220, 53, 69, 0.15);
        color: #ff8a95;
        border: 1px solid rgba(220, 53, 69, 0.25);
    }

    .login-page .alert-success {
        background: rgba(25, 135, 84, 0.15);
        color: #75d9a3;
        border: 1px solid rgba(25, 135, 84, 0.25);
    }

    .login-page .alert-warning {
        background: rgba(255, 193, 7, 0.12);
        color: #ffd666;
        border: 1px solid rgba(255, 193, 7, 0.25);
    }

    .login-page .field-error {
        color: #ff8a95;
        font-size: 0.8rem;
        display: block;
        margin-top: 6px;
        padding: 10px 14px;
        line-height: 1.45;
        border-radius: 10px;
        background: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.2);
    }

    .login-page .field-error:empty {
        display: none;
        padding: 0;
        margin: 0;
        border: none;
        background: none;
    }

    .login-resend {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .login-resend__toggle {
        background: none;
        border: none;
        color: #0079D4;
        font-size: 0.875rem;
        padding: 0;
        cursor: pointer;
        text-decoration: underline;
    }

    .login-resend__form {
        display: none;
        margin-top: 12px;
    }

    .login-resend__form.is-open {
        display: block;
    }

    .login-resend__form .btn-resend {
        width: 100%;
        margin-top: 10px;
        background: transparent;
        border: 1px solid #0079D4;
        color: #0079D4;
        border-radius: 10px;
        padding: 10px 0;
        font-weight: 600;
        font-size: 0.9rem;
        transition: background-color 0.2s, color 0.2s;
    }

    .login-resend__form .btn-resend:hover {
        background: #0079D4;
        color: #fff;
    }

    .auth-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 121, 212, 0.12);
        border: 1px solid rgba(0, 121, 212, 0.3);
        color: #0079D4;
        font-size: 1.5rem;
    }

    .auth-steps {
        list-style: none;
        margin: 0 0 24px;
        padding: 14px 16px;
        border-radius: 10px;
        background: #1a1a1a;
        border: 1px solid rgba(255, 255, 255, 0.06);
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .auth-steps li {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        color: #c4c4c4;
        font-size: 0.85rem;
        line-height: 1.45;
    }

    .auth-steps li + li {
        margin-top: 8px;
    }

    .auth-steps__num {
        flex: 0 0 20px;
        height: 20px;
        border-radius: 50%;
        background: #0079D4;
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-top: 1px;
    }

    .auth-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #a0a0a0;
        font-size: 0.9rem;
        text-decoration: none;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
        transition: color 0.2s;
    }

    .auth-back:hover {
        color: #fff;
    }

    .auth-hint {
        display: block;
        margin-top: 6px;
        font-size: 0.8rem;
        color: #6b6b6b;
        font-family: 'Space Grotesk', 'Instrument Sans', system-ui, sans-serif;
    }

    .auth-hint.is-ok {
        color: #75d9a3;
    }

    .auth-hint.is-bad {
        color: #ff8a95;
    }

    .login-page .btn-continue:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
</style>
