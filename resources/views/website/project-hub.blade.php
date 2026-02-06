@extends('layouts.website.master')
@section('title', $page_title)
@section('content')

    {{-- @php
        if (Auth::check() && Auth::user()->package_id == 1) {
            header("Location: " . url('/'));
            exit();
        }
    @endphp --}}

    <style>
        .row {
            width: unset;
        }

        .project-hub-sec {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .project-hub-card {
            background-color: #004B87;
            color: white;
            padding: 40px;
            border-radius: 8px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .project-hub-card h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 25px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .project-hub-card p {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
        }

        .project-hub-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .project-hub-card-link {
            display: block;
            text-decoration: none;
            height: 100%;
            width: 100%;
        }

        .project-hub-card-link:hover {
            text-decoration: none;
        }

        /* Job Posts Section */
        .jobs-section {
            background-color: white;
            margin-bottom: 20%;
            position: relative;
            z-index: 1;
        }

        .jobs-section .container {
            margin-top: 20px;
        }

        .section-title {
            font-size: 50px;
            color: #004B87;
            font-weight: 600;
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            padding-top: 20px;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: #F7A823;
            margin: 15px auto 0;
        }

        .job-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }

        .job-image {
            width: 100%;
            height: 500px;
            object-fit: fill;
        }

        .job-content {
            padding: 25px;
        }

        .job-title {
            font-size: 20px;
            color: #004B87;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .job-description {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .read-more-btn {
            display: inline-block;
            padding: 10px 25px;
            background-color: #004B87;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .read-more-btn:hover {
            background-color: #003666;
            color: white;
            text-decoration: none;
        }

        /* Contact Form Styles */
        .contact-form-section {
            margin-top: 80px;
            margin-bottom: 80px;
            position: relative;
            z-index: 10;
        }

        .contact-form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
        }

        .contact-form-title {
            text-align: center;
            color: #004B87;
            margin-bottom: 30px;
            font-size: 32px;
            font-weight: 600;
        }

        .contact-form-subtitle {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin-bottom: 40px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px 15px;
            margin-bottom: 20px;
            width: 100%;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #004B87;
            box-shadow: 0 0 0 0.2rem rgba(0, 75, 135, 0.25);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            background-color: #004B87;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #003666;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .project-hub-card {
                margin-bottom: 20px;
            }

            .section-title {
                font-size: 28px;
            }

            .job-content {
                padding: 20px;
            }

            .jobs-section {
                margin: 40px 0;
                padding: 60px 0;
            }

            .section-title {
                margin-bottom: 40px;
            }

            .contact-form-section {
                margin-top: 60px;
                margin-bottom: 60px;
            }

            .contact-form-container {
                padding: 30px;
            }

            .contact-form-title {
                font-size: 28px;
            }
        }
    </style>

    @if (!empty($banner->image))
        <section class="inner-banner project-hub"
            style="background-image: url('{{asset('/admin/assets/images/banner') }}/{{ $banner->image }}');">
        @else
            <section class="inner-banner project-hub"
                style="background-image: url('{{asset('/admin/assets/images/images.png') }}');" style="width:100%">
    @endif
    <div class="banner-wrapper position-relative z-1">
        <div class="container">
            <div class="row">
                @include('website.include.social-links')
                <div class="col-lg-10 col-xl-9" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="card">
                        <div class="shape-1"></div>
                        @if (isset($banner))
                            <h1 class="hd-70">{{ $banner->name }}</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    {{-- <section class="project-hub-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    @php
                        $canAccessProjects = false;
                        if (Auth::check()) {
                            $user = Auth::user();
                            if ($user->hasRole('Admin') || $user->hasRole('EPC Developer') || $user->package_id == 2 || $user->package_id == 3) {
                                $canAccessProjects = true;
                            }
                        }
                    @endphp
                    <a href="{{ $canAccessProjects ? route('projects.index') : route('login') }}"
                        class="project-hub-card-link">
                        <div class="project-hub-card">
                            <h2>PROJECT LISTINGS</h2>
                            <p>Browse and discover available projects in your area. Connect with potential clients and
                                expand your business opportunities through our comprehensive project listings.</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    @php
                        $canAccessMemberDirectory = false;
                        if (Auth::check()) {
                            $user = Auth::user();
                            if ($user->hasRole('Admin') || $user->hasRole('EPC Developer') || $user->package_id == 2 || $user->package_id == 3) {
                                $canAccessMemberDirectory = true;
                            }
                        }
                    @endphp
                    <a href="{{ $canAccessMemberDirectory ? route('member_directory.index') : route('login') }}"
                        class="project-hub-card-link">
                        <div class="project-hub-card">
                            <h2>MEMBER DIRECTORY</h2>
                            <p>Access our extensive network of professional members. Find trusted partners, collaborators,
                                and service providers to help grow your business.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="jobs-section">
        <div class="container">
            <h1 class="section-title">Latest Projects</h1>
            <div class="row">
                @foreach ($projects as $project)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="job-card">
                            <div class="job-image-container">
                                @if ($project->image)
                                    <img src="{{ asset('/admin/assets/images/projects/' . $project->image) }}" class="job-image" alt="{{ $project->name }}">
                                @else
                                    <img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}" class="job-image" alt="Default Image">
                                @endif
                            </div>
                            <div class="job-content">
                                <h3 class="job-title">{{ $project->name }}</h3>
                                
                                <h2 class="job-description">
                                    @php
                                        $categories = json_decode($project->project_category_id, true);
                                        $categoryTitles = [];
                                        if (is_array($categories)) {
                                            foreach ($categories as $categoryId) {
                                                $title = \App\Models\Category::find($categoryId)->title ?? null;
                                                if ($title) {
                                                    $categoryTitles[] = $title;
                                                }
                                            }
                                        }
                                    @endphp
                                    {{ !empty($categoryTitles) ? implode(', ', $categoryTitles) : 'N/A' }}
                                </h2>
                                <p class="job-description">
                                    {{ Str::limit($project->description, 100, '...') }}
                                </p>
                                @php
                                    $canViewProject = false;
                                    $showReadMore = true;
                                    if (Auth::check()) {
                                        $user = Auth::user();
                                        if ($user->hasRole('Admin') || $user->package_id == 2) {
                                            // Admins and package 2 can view all projects
                                            $canViewProject = true;
                                        } elseif ($user->hasRole('EPC Developer') || $user->package_id == 3) {
                                            // EPC Developer (by role or package_id 3) can view other EPC Developer's projects, but not their own
                                            if ($project->created_by != $user->id) {
                                                $canViewProject = true;
                                            } else {
                                                $showReadMore = false; // Hide button for own project
                                            }
                                        }
                                    }
                                @endphp
                                @if ($showReadMore)
                                    <a href="{{ $canViewProject ? route('project.details', $project->id) : route('registration') }}"
                                        class="read-more-btn">Read More</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
