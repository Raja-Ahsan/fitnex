<style>
    .legal-page {
        padding: 3rem 0 4rem;
        background: #0a0a0a;
    }

    .legal-page__card {
        background: linear-gradient(145deg, rgba(0, 163, 255, 0.08), rgba(255, 255, 255, 0.03));
        border: 1px solid rgba(0, 163, 255, 0.25);
        border-radius: 16px;
        padding: 2rem 1.5rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
    }

    @media (min-width: 768px) {
        .legal-page__card {
            padding: 2.5rem 2.75rem;
        }
    }

    .legal-page__eyebrow {
        margin: 0 0 0.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #00A3FF;
    }

    .legal-page__title {
        margin: 0 0 1.5rem;
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        font-weight: 700;
        line-height: 1.2;
        color: #fff;
    }

    .legal-page__title * {
        color: inherit;
        margin: 0;
    }

    .legal-prose {
        color: #d1d5db;
        font-size: 1rem;
        line-height: 1.75;
    }

    .legal-prose > :first-child {
        margin-top: 0;
    }

    .legal-prose > :last-child {
        margin-bottom: 0;
    }

    .legal-prose p {
        margin: 0 0 1rem;
    }

    .legal-prose h1,
    .legal-prose h2,
    .legal-prose h3,
    .legal-prose h4 {
        color: #fff;
        font-weight: 700;
        line-height: 1.35;
        margin: 1.75rem 0 0.75rem;
    }

    .legal-prose h1 { font-size: 1.5rem; }
    .legal-prose h2 { font-size: 1.35rem; }
    .legal-prose h3 { font-size: 1.15rem; }
    .legal-prose h4 { font-size: 1.05rem; }

    .legal-prose ul,
    .legal-prose ol {
        margin: 0 0 1rem 1.25rem;
        padding: 0;
    }

    .legal-prose li {
        margin-bottom: 0.5rem;
    }

    .legal-prose a {
        color: #00A3FF;
        text-decoration: underline;
        text-underline-offset: 2px;
    }

    .legal-prose a:hover {
        color: #66c7ff;
    }

    .legal-prose strong,
    .legal-prose b {
        color: #fff;
        font-weight: 600;
    }

    .legal-prose blockquote {
        margin: 1rem 0;
        padding: 0.75rem 1rem;
        border-left: 3px solid #00A3FF;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 0 8px 8px 0;
    }

    .legal-prose table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
        font-size: 0.95rem;
    }

    .legal-prose th,
    .legal-prose td {
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 0.6rem 0.75rem;
        text-align: left;
    }

    .legal-prose th {
        background: rgba(0, 163, 255, 0.12);
        color: #fff;
    }

    .legal-page__empty {
        margin: 0;
        padding: 1rem;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        color: #9ca3af;
        font-style: italic;
    }
</style>
