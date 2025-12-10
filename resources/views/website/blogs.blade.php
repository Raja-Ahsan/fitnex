@extends('layouts.website.master')
@section('title', $page_title)

<style>
    .primary-theme-text {
        color: #00A3FF !important;
    }

    .blog-category-section {
        padding: 40px 0;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .blog-list-section {
        padding: 60px 0;
        background-color: #ffffff;
    }

    /* Custom Category Tabs Styling - No Bootstrap */
    .custom-tabs-container {
        display: flex !important;
        justify-content: center !important;
        margin: 0 auto !important;
        width: 100% !important;
    }

    .custom-tabs {
        display: flex !important;
        background-color: #e4e4e4 !important;
        border-radius: 8px !important;
        padding: 8px !important;
        gap: 4px !important;
        overflow-x: auto !important;
        scrollbar-width: none !important;
        width: fit-content !important;
        margin: 0 auto !important;
    }

    .custom-tabs::-webkit-scrollbar {
        display: none !important;
    }

    .custom-tab {
        background-color: #ffffff !important;
        border: none !important;
        border-radius: 6px !important;
        color: #6c757d !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        padding: 10px 16px !important;
        text-transform: uppercase !important;
        transition: all 0.3s ease !important;
        min-width: 90px !important;
        text-align: center !important;
        white-space: nowrap !important;
        cursor: pointer !important;
        display: inline-block !important;
        text-decoration: none !important;
        outline: none !important;
    }

    .custom-tab.active {
        background-color: #007bff !important;
        color: #ffffff !important;
    }

    .custom-tab:hover:not(.active) {
        background-color: #e9ecef !important;
        color: #007bff !important;
    }

    /* Custom Tab Content Styling */
    .custom-tab-content {
        margin-top: 40px;
    }

    .custom-tab-pane {
        display: none;
    }

    .custom-tab-pane.active {
        display: block;
    }

    /* Blog Post Container Styling */
    .blog-post-container {
        max-width: 900px;
        margin: 0 auto 40px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-post-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .blog-post-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #2c3e50;
        line-height: 1.3;
        padding: 0 30px;
        padding-top: 30px;
    }

    .blog-post-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 25px;
        padding: 0 30px;
        border-bottom: 1px solid #f1f3f4;
        padding-bottom: 20px;
    }

    .blog-post-meta-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .blog-post-meta-left span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .blog-post-meta-right {
        font-weight: 600;
        color: #007bff;
        background-color: #e3f2fd;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .blog-post-image {
        width: 100%;
        height: 350px;
        object-fit: cover;
        margin: 0;
        border-radius: 0;
    }

    .blog-post-content {
        font-size: 16px;
        color: #4a5568;
        line-height: 1.8;
        padding: 0 30px 30px;
        font-family: 'Roboto', 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
    }

    /* Custom Button Styling */
    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        color: #fff;
        background-color: #545b62;
        border-color: #4e555b;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    /* Blog Content Animation */
    .blog-excerpt,
    .blog-full-content {
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .read-more-btn,
    .read-less-btn {
        transition: all 0.3s ease;
    }

    .blog-medium-content {
        margin-top: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .nav-tabs {
            padding: 6px;
            gap: 2px;
        }

        .nav-tabs .nav-link {
            padding: 8px 12px;
            font-size: 11px;
            min-width: 80px;
        }

        .blog-post-title {
            font-size: 24px;
            padding: 0 20px;
            padding-top: 25px;
        }

        .blog-post-meta {
            padding: 0 20px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .blog-post-content {
            padding: 0 20px 25px;
        }
    }
</style>



@section('content')

    <!-- Banner Section -->
    <section class="inner-banner listing-banner"
        style="background: url('{{ $banner && $banner->image ? asset('/admin/assets/images/banner/' . $banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
        <div class="container">
            <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1]" data-aos="flip-right"
                data-aos-easing="linear" data-aos-duration="1500">
                @php
                    $title = $banner && $banner->name ? $banner->name : '';
                    $parts = explode(' ', $title, 2);
                @endphp
                <span class="italic uppercase font-black">
                    <span class="primary-theme-text">{{ $parts[0] }}</span>
                    @if (isset($parts[1]))
                        {{ $parts[1] }}
                    @endif
                </span>
            </h1>
        </div>
    </section>

    <section class="blog-category-section">
        <div class="container">
            <!-- Custom Blog Category Tabs -->
            <div class="custom-tabs-container">
                <div class="custom-tabs">
                    <button class="custom-tab active" data-target="all-blogs">All Blogs</button>
                    @foreach ($blog_categories as $category)
                        <button class="custom-tab"
                            data-target="category-{{ $category->slug }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="blog-list-section">
        <div class="container">
            <!-- Blog Content by Tab -->
            <div class="custom-tab-content">
                <!-- All Blogs -->
                <div class="custom-tab-pane active" id="all-blogs">
                    @if ($blogs->count())
                        @foreach ($blogs as $blog)
                            @include('website.components.blog-card', ['blog' => $blog])
                        @endforeach
                    @else
                        <div class="text-center" style="padding: 60px 20px;">
                            <i class="fas fa-newspaper" style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
                            <h3 style="color: #666; margin-bottom: 10px;">No Blogs Found</h3>
                            <p style="color: #999;">There are no blogs available at the moment.</p>
                        </div>
                    @endif
                </div>

                <!-- Category-Specific Blogs -->
                @foreach ($blog_categories as $category)
                    <div class="custom-tab-pane" id="category-{{ $category->slug }}">
                        @php
                            $categoryBlogs = $blogs->where('category_slug', $category->slug);
                        @endphp
                        @if ($categoryBlogs->count())
                            @foreach ($categoryBlogs as $blog)
                                @include('website.components.blog-card', ['blog' => $blog])
                            @endforeach
                        @else
                            <div class="text-center" style="padding: 60px 20px;">
                                <i class="fas fa-folder-open"
                                    style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
                                <h3 style="color: #666; margin-bottom: 10px;">No Blogs in {{ $category->name }}</h3>
                                <p style="color: #999;">There are no blogs available in this category at the moment.</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab functionality
        const tabs = document.querySelectorAll('.custom-tab');
        const tabPanes = document.querySelectorAll('.custom-tab-pane');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs and panes
                tabs.forEach(t => t.classList.remove('active'));
                tabPanes.forEach(pane => pane.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');

                // Show corresponding content
                const targetId = this.getAttribute('data-target');
                const targetPane = document.getElementById(targetId);
                if (targetPane) {
                    targetPane.classList.add('active');
                }
            });
        });

        // Multi-level Read More/Less functionality
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('read-more-btn')) {
                const blogId = e.target.getAttribute('data-blog-id');
                const level = parseInt(e.target.getAttribute('data-level'));
                const blogContainer = e.target.closest('.blog-post-container');

                // Get all content sections for this blog
                const excerpt = blogContainer.querySelector('.blog-excerpt');
                const mediumContent = blogContainer.querySelector('.blog-medium-content');
                const fullContent = blogContainer.querySelector('.blog-full-content');

                // Get all buttons for this blog
                const readMoreBtn1 = blogContainer.querySelector('.read-more-btn[data-level="1"]');
                const readMoreBtn2 = blogContainer.querySelector('.read-more-btn[data-level="2"]');
                const readLessBtn1 = blogContainer.querySelector('.read-less-btn[data-level="1"]');
                const readLessBtn2 = blogContainer.querySelector('.read-less-btn[data-level="2"]');

                if (level === 1) {
                    // First level: Show medium content or full content
                    excerpt.style.display = 'none';

                    if (mediumContent) {
                        // If medium content exists, show it
                        mediumContent.style.display = 'block';
                        fullContent.style.display = 'none';

                        // Show level 2 read more button
                        readMoreBtn1.style.display = 'none';
                        readMoreBtn2.style.display = 'inline-block';
                        readLessBtn1.style.display = 'none';
                        readLessBtn2.style.display = 'none';

                        // Smooth scroll to medium content
                        mediumContent.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });
                    } else {
                        // If no medium content, show full content directly
                        fullContent.style.display = 'block';

                        // Show read less button
                        readMoreBtn1.style.display = 'none';
                        readLessBtn1.style.display = 'inline-block';

                        // Smooth scroll to full content
                        fullContent.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });
                    }
                } else if (level === 2) {
                    // Second level: Show full content
                    excerpt.style.display = 'none';
                    mediumContent.style.display = 'none';
                    fullContent.style.display = 'block';

                    // Show level 2 read less button
                    readMoreBtn1.style.display = 'none';
                    readMoreBtn2.style.display = 'none';
                    readLessBtn1.style.display = 'none';
                    readLessBtn2.style.display = 'inline-block';

                    // Smooth scroll to full content
                    fullContent.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }
            }

            if (e.target.classList.contains('read-less-btn')) {
                const blogId = e.target.getAttribute('data-blog-id');
                const level = parseInt(e.target.getAttribute('data-level'));
                const blogContainer = e.target.closest('.blog-post-container');

                // Get all content sections for this blog
                const excerpt = blogContainer.querySelector('.blog-excerpt');
                const mediumContent = blogContainer.querySelector('.blog-medium-content');
                const fullContent = blogContainer.querySelector('.blog-full-content');

                // Get all buttons for this blog
                const readMoreBtn1 = blogContainer.querySelector('.read-more-btn[data-level="1"]');
                const readMoreBtn2 = blogContainer.querySelector('.read-more-btn[data-level="2"]');
                const readLessBtn1 = blogContainer.querySelector('.read-less-btn[data-level="1"]');
                const readLessBtn2 = blogContainer.querySelector('.read-less-btn[data-level="2"]');

                if (level === 1) {
                    // Go back to excerpt
                    excerpt.style.display = 'block';
                    mediumContent.style.display = 'none';
                    fullContent.style.display = 'none';

                    // Show level 1 read more button
                    readMoreBtn1.style.display = 'inline-block';
                    readMoreBtn2.style.display = 'none';
                    readLessBtn1.style.display = 'none';
                    readLessBtn2.style.display = 'none';

                    // Smooth scroll to excerpt
                    excerpt.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                } else if (level === 2) {
                    // Go back to medium content
                    excerpt.style.display = 'none';
                    mediumContent.style.display = 'block';
                    fullContent.style.display = 'none';

                    // Show level 2 read more button
                    readMoreBtn1.style.display = 'none';
                    readMoreBtn2.style.display = 'inline-block';
                    readLessBtn1.style.display = 'none';
                    readLessBtn2.style.display = 'none';

                    // Smooth scroll to medium content
                    mediumContent.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }
            }
        });
    });
</script>
