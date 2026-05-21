<style>
    :root {
        --fit-primary: #004274;
        --fit-secondary: #0079d4;
        --fit-accent: #00a3ff;
        --fit-ink: #0f1720;
        --fit-muted: #6c7a88;
        --fit-border: #e5eaf0;
        --fit-bg: #f4f8fc;
        --fit-radius: 14px;
        --fit-shadow: 0 12px 28px rgba(0, 66, 116, 0.1);
    }

    .trainer-themed-page {
        /* max-width: 1100px; */
        margin: 0 auto;
    }

    .fitnex-hero {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 18px 22px;
        margin-bottom: 20px;
        border-radius: var(--fit-radius);
        color: #fff;
        background: linear-gradient(135deg, var(--fit-primary), var(--fit-secondary));
        box-shadow: var(--fit-shadow);
    }

    .fitnex-hero h1 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.25;
    }

    .fitnex-hero p {
        margin: 6px 0 0;
        font-size: 13px;
        opacity: 0.9;
    }

    .fitnex-hero .btn-hero {
        background: #fff;
        color: var(--fit-primary);
        border: none;
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 18px;
        white-space: nowrap;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .fitnex-hero .btn-hero:hover,
    .fitnex-hero .btn-hero:focus {
        color: var(--fit-secondary);
        background: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .fitnex-panel {
        background: #fff;
        border: 1px solid var(--fit-border);
        border-radius: var(--fit-radius);
        box-shadow: var(--fit-shadow);
        overflow: hidden;
    }

    .fitnex-panel__body {
        padding: 20px 22px;
    }

    .fitnex-alert {
        border-radius: 10px;
        border: none;
        padding: 12px 16px;
        margin-bottom: 16px;
    }

    .fitnex-alert--success {
        background: #e8f5e9;
        color: #1b5e20;
    }

    .fitnex-alert--info {
        background: #e3f2fd;
        color: #0d47a1;
    }

    .fitnex-alert--info a {
        color: var(--fit-secondary);
        font-weight: 600; 
        color: #ffffff;
    }

    .fitnex-table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .fitnex-table {
        width: 100%;
        margin-bottom: 0;
    }

    .fitnex-table thead th {
        background: var(--fit-bg);
        color: var(--fit-primary);
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 2px solid var(--fit-border) !important;
        white-space: nowrap;
    }

    .fitnex-table tbody td {
        vertical-align: middle !important;
        border-color: var(--fit-border) !important;
    }

    .fitnex-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.02em;
    }

    .fitnex-badge--info {
        background: rgba(0, 121, 212, 0.12);
        color: var(--fit-secondary);
    }

    .fitnex-badge--success {
        background: rgba(46, 125, 50, 0.12);
        color: #2e7d32;
    }

    .fitnex-badge--muted {
        background: #eceff3;
        color: var(--fit-muted);
    }

    .fitnex-badge--warning {
        background: rgba(245, 127, 23, 0.12);
        color: #e65100;
    }

    .fitnex-badge--danger {
        background: rgba(198, 40, 40, 0.12);
        color: #c62828;
    }

    .fitnex-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .fitnex-stat-card {
        background: #fff;
        border: 1px solid var(--fit-border);
        border-radius: var(--fit-radius);
        padding: 16px 18px;
        box-shadow: var(--fit-shadow);
        display: flex;
        flex-direction: column;
        gap: 4px;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
        text-decoration: none;
        color: inherit;
    }

    a.fitnex-stat-card:hover,
    a.fitnex-stat-card:focus {
        text-decoration: none;
        color: inherit;
        transform: translateY(-2px);
        box-shadow: 0 14px 32px rgba(0, 66, 116, 0.14);
    }

    .fitnex-stat-card__value {
        font-size: 26px;
        font-weight: 700;
        color: var(--fit-primary);
        line-height: 1.2;
    }

    .fitnex-stat-card__label {
        font-size: 12px;
        font-weight: 600;
        color: var(--fit-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .fitnex-stat-card__icon {
        align-self: flex-end;
        margin-top: -28px;
        font-size: 28px;
        opacity: 0.2;
        color: var(--fit-secondary);
    }

    .fitnex-stat-card__link {
        font-size: 12px;
        color: var(--fit-secondary);
        font-weight: 600;
        margin-top: 6px;
    }

    .fitnex-stat-card--accent .fitnex-stat-card__value {
        color: var(--fit-secondary);
    }

    .fitnex-panel__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 14px 20px;
        border-bottom: 1px solid var(--fit-border);
        background: var(--fit-bg);
    }

    .fitnex-panel__head h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: var(--fit-primary);
    }

    .fitnex-panel__foot {
        padding: 12px 20px;
        border-top: 1px solid var(--fit-border);
        text-align: right;
        background: var(--fit-bg);
    }

    .fitnex-filter-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        padding: 14px 18px;
        background: var(--fit-bg);
        border-bottom: 1px solid var(--fit-border);
        font-weight: 700;
        color: var(--fit-primary);
        margin: 0;
    }

    .fitnex-filter-body.collapsed {
        display: none;
    }

    .fitnex-filter-body {
        padding: 18px 20px;
    }

    .fitnex-quick-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 10px;
    }

    .fitnex-quick-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 16px 10px;
        border: 1px solid var(--fit-border);
        border-radius: 12px;
        background: var(--fit-bg);
        color: var(--fit-primary);
        font-weight: 600;
        font-size: 12px;
        text-decoration: none;
        transition: background 0.15s ease, border-color 0.15s ease;
    }

    .fitnex-quick-btn:hover,
    .fitnex-quick-btn:focus {
        text-decoration: none;
        color: var(--fit-secondary);
        background: #fff;
        border-color: var(--fit-secondary);
    }

    .fitnex-quick-btn i {
        font-size: 22px;
        color: var(--fit-secondary);
    }

    .fitnex-activity-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .fitnex-activity-item {
        display: flex;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--fit-border);
    }

    .fitnex-activity-item:last-child {
        border-bottom: none;
    }

    .fitnex-activity-item img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--fit-border);
    }

    .fitnex-activity-item__body {
        flex: 1;
        min-width: 0;
    }

    .fitnex-activity-item__title {
        font-weight: 700;
        color: var(--fit-primary);
        display: flex;
        justify-content: space-between;
        gap: 8px;
    }

    .fitnex-activity-item__meta {
        font-size: 12px;
        color: var(--fit-muted);
        margin-top: 4px;
    }

    .fitnex-dash-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 20px;
        align-items: start;
    }

    .booking-cards,
    .dashboard-session-cards {
        display: none;
    }

    .booking-card,
    .dashboard-session-card {
        border: 1px solid var(--fit-border);
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 12px;
        background: var(--fit-bg);
    }

    .booking-card__id,
    .dashboard-session-card__date {
        font-size: 16px;
        font-weight: 700;
        color: var(--fit-primary);
        margin-bottom: 8px;
    }

    .booking-card__row,
    .dashboard-session-card__row {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .booking-card__row span:first-child,
    .dashboard-session-card__row span:first-child {
        color: var(--fit-muted);
    }

    .fitnex-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .btn-fit-primary {
        background: var(--fit-secondary);
        border-color: var(--fit-secondary);
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-fit-primary:hover,
    .btn-fit-primary:focus {
        background: var(--fit-primary);
        border-color: var(--fit-primary);
        color: #fff;
    }

    .btn-fit-outline {
        background: #fff;
        border: 1px solid var(--fit-border);
        color: var(--fit-primary);
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-fit-warning {
        background: #fff8e1;
        border: 1px solid #ffe082;
        color: #f57f17;
        border-radius: 8px;
    }

    .btn-fit-danger {
        background: #ffebee;
        border: 1px solid #ffcdd2;
        color: #c62828;
        border-radius: 8px;
    }

    .fitnex-form-card {
        /* max-width: 720px; */
        margin: 0 auto;
    }

    .fitnex-form-card .control-label {
        color: var(--fit-primary);
        font-weight: 600;
        font-size: 13px;
    }

    .fitnex-form-card .form-control {
        border-radius: 10px;
        border-color: var(--fit-border);
        min-height: 40px;
        box-shadow: none;
    }

    .fitnex-form-card .form-control:focus {
        border-color: var(--fit-secondary);
        box-shadow: 0 0 0 3px rgba(0, 121, 212, 0.15);
    }

    .fitnex-form-hint {
        font-size: 12px;
        color: var(--fit-muted);
        margin-top: 6px;
    }

    .slots-pagination .pagination {
        margin: 0;
    }

    .slots-pagination .pagination > li > a,
    .slots-pagination .pagination > li > span {
        border-radius: 8px;
        margin: 0 2px;
        color: var(--fit-primary);
    }

    .slots-pagination .pagination > .active > a,
    .slots-pagination .pagination > .active > span {
        background: var(--fit-primary);
        border-color: var(--fit-primary);
    }

    .google-privacy-box {
        border: 1px solid var(--fit-border);
        border-radius: 10px;
        padding: 14px 16px;
        margin: 18px 0;
        background: var(--fit-bg);
    }

    .google-privacy-box h5 {
        margin: 0 0 8px;
        font-size: 14px;
        font-weight: 700;
        color: var(--fit-primary);
    }

    .google-privacy-box p {
        margin: 0;
        font-size: 13px;
        color: var(--fit-muted);
        line-height: 1.5;
    }

    .fitnex-form-footer {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: space-between;
        align-items: center;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid var(--fit-border);
    }

    .fitnex-check label {
        font-weight: 500;
        color: var(--fit-ink);
    }

    .availability-cards {
        display: none;
    }

    @media (max-width: 991px) {
        .fitnex-stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .fitnex-dash-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .fitnex-stat-grid {
            grid-template-columns: 1fr;
        }

        .fitnex-hero {
            padding: 16px;
        }

        .fitnex-hero h1 {
            font-size: 18px;
        }

        .fitnex-hero .btn-hero {
            width: 100%;
            text-align: center;
        }

        .fitnex-panel__body {
            padding: 16px;
        }

        .fitnex-table-desktop {
            display: none;
        }

        .availability-cards,
        .booking-cards,
        .dashboard-session-cards {
            display: block;
        }

        .availability-card {
            border: 1px solid var(--fit-border);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 12px;
            background: var(--fit-bg);
        }

        .availability-card__day {
            font-size: 16px;
            font-weight: 700;
            color: var(--fit-primary);
            margin-bottom: 8px;
        }

        .availability-card__row {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            font-size: 13px;
            margin-bottom: 6px;
            color: var(--fit-ink);
        }

        .availability-card__row span:first-child {
            color: var(--fit-muted);
        }

        .availability-card .fitnex-actions {
            margin-top: 12px;
        }

        .availability-card .fitnex-actions .btn {
            flex: 1;
            min-width: 0;
        }

        .fitnex-form-footer .btn {
            flex: 1;
            min-width: calc(50% - 5px);
        }

        .fitnex-form-footer .btn-fit-outline {
            order: 2;
        }

        .fitnex-form-footer .btn-fit-primary {
            order: 1;
            width: 100%;
            flex: 1 1 100%;
            margin-bottom: 4px;
        }
    }
</style>
