<style>
    :root {
        --admin-primary: #004274;
        --admin-secondary: #0079d4;
        --admin-border: #e5eaf0;
        --admin-bg: #f4f8fc;
        --admin-radius: 12px;
        --admin-shadow: 0 10px 24px rgba(0, 66, 116, 0.08);
    }

    .admin-themed-page {
        margin: 0 auto;
        background: #fff;
        border: 1px solid var(--admin-border);
        border-radius: var(--admin-radius);
        box-shadow: var(--admin-shadow);
        overflow: hidden;
    }

    .admin-hero {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 20px;
        margin-bottom: 0;
        border-radius: 0;
        color: var(--admin-primary);
        background: #fff;
        border: none;
        border-bottom: 1px solid var(--admin-border);
        box-shadow: none;
    }

    .admin-hero h1 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        color: var(--admin-primary);
    }

    .admin-hero p {
        margin: 4px 0 0;
        font-size: 13px;
        color: #6c7a88;
    }

    .admin-hero .btn-hero {
        background: var(--admin-secondary);
        color: #fff;
        border: none;
        font-weight: 600;
        border-radius: 8px;
        padding: 8px 16px;
    }

    .admin-themed-page .admin-panel {
        border: none;
        border-radius: 0;
        box-shadow: none;
        margin-bottom: 0;
    }

    .admin-themed-page .admin-alert-success {
        margin: 12px 18px 0;
    }

    .admin-panel {
        background: #fff;
        border: 1px solid var(--admin-border);
        border-radius: var(--admin-radius);
        box-shadow: var(--admin-shadow);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .admin-panel__head {
        padding: 14px 18px;
        border-bottom: 1px solid var(--admin-border);
        background: var(--admin-bg);
        font-weight: 700;
        color: var(--admin-primary);
    }

    .admin-panel__body {
        padding: 18px;
    }

    .admin-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 16px;
    }

    .admin-filters .form-control {
        border-radius: 8px;
        min-height: 38px;
    }

    .admin-table {
        width: 100%;
        margin-bottom: 0;
    }

    .admin-table thead th {
        background: var(--admin-bg);
        color: var(--admin-primary);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 2px solid var(--admin-border) !important;
        white-space: nowrap;
    }

    .admin-table tbody td {
        vertical-align: middle !important;
        border-color: var(--admin-border) !important;
    }

    .admin-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
    }

    .admin-badge--success {
        background: rgba(46, 125, 50, 0.12);
        color: #2e7d32;
    }

    .admin-badge--danger {
        background: rgba(198, 40, 40, 0.12);
        color: #c62828;
    }

    .admin-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .btn-admin-primary {
        background: var(--admin-secondary);
        border-color: var(--admin-secondary);
        color: #fff;
        border-radius: 6px;
    }

    .btn-admin-danger {
        border-radius: 6px;
    }

    .admin-truncate {
        max-width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-alert-success {
        background: #e8f5e9;
        color: #1b5e20;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 16px;
    }

    @media (max-width: 991px) {
        .admin-table-desktop { display: none; }
        .admin-cards { display: block; }
    }

    @media (min-width: 992px) {
        .admin-cards { display: none; }
    }

    .admin-card {
        border: 1px solid var(--admin-border);
        border-radius: 10px;
        padding: 14px;
        margin-bottom: 12px;
        background: var(--admin-bg);
    }

    .admin-card__title {
        font-weight: 700;
        color: var(--admin-primary);
        margin-bottom: 8px;
    }

    .admin-card__row {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        margin-bottom: 4px;
    }

    /* Global admin polish (all pages using layouts.admin.app) */
    .content-wrapper {
        background: var(--admin-bg) !important;
    }

    .content-wrapper > section.content,
    .content-wrapper > .content {
        padding: 20px 24px 28px !important;
    }

    /* Page title bar — part of the content card, not a floating banner */
    .content-wrapper > section.content-header {
        background: #fff !important;
        border: 1px solid var(--admin-border);
        border-radius: var(--admin-radius) var(--admin-radius) 0 0;
        margin: 20px 24px 20px !important;
        padding: 16px 20px !important;
        color: var(--admin-primary);
        box-shadow: none;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        min-height: auto;
    }

    .content-header h1,
    .content-header .content-header-left h1,
    .content-header > h1 {
        color: var(--admin-primary) !important;
        font-size: 22px;
        font-weight: 700;
        margin: 0 !important;
    }

    .content-header .content-header-left,
    .content-header .content-header-right {
        float: none !important;
        width: auto;
    }

    .content-header .content-header-right a,
    .content-header .btn {
        background: var(--admin-secondary) !important;
        color: #fff !important;
        border: none;
        border-radius: 8px;
        font-weight: 600;
    }

    /* Connect header to the white content box below */
    section.content-header + section.content {
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    section.content-header + section.content > .row:first-child,
    section.content-header + section.content > .box:first-child {
        margin-top: 0;
    }

    section.content-header + section.content .box {
        border-top: none;
        border-radius: 0 0 var(--admin-radius) var(--admin-radius);
        margin-top: 0;
        box-shadow: var(--admin-shadow);
    }

    section.content-header + section.content .box .box-header {
        border-radius: 0;
    }

    .content .box,
    section.content > .box {
        border-radius: var(--admin-radius);
        border: 1px solid var(--admin-border);
        box-shadow: var(--admin-shadow);
        overflow: hidden;
        background: #fff;
    }

    .content .box-header {
        background: var(--admin-bg);
        border-bottom: 1px solid var(--admin-border);
    }

    .content .box-header .box-title {
        color: var(--admin-primary);
        font-weight: 700;
    }

    .content .table > thead > tr > th {
        background: var(--admin-bg);
        color: var(--admin-primary);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 2px solid var(--admin-border);
    }

    .content .table > tbody > tr > td {
        vertical-align: middle;
        border-color: var(--admin-border);
    }

    .content .info-box {
        border-radius: var(--admin-radius);
        box-shadow: var(--admin-shadow);
        overflow: hidden;
    }

    .content .btn-primary {
        background-color: var(--admin-secondary) !important;
        border-color: var(--admin-secondary) !important;
        border-radius: 8px;
    }

    .content .callout-success {
        border-radius: 8px;
        border-color: #a5d6a7;
        background: #e8f5e9;
        color: #1b5e20;
    }
</style>
