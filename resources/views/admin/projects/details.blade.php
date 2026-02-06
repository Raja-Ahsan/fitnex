@extends((Auth::user()->hasRole('Admin') ? 'layouts.admin.app' :  (Auth::user()->hasRole('EPC Developer') ? 'layouts.epc-developer.app' : 'layouts.member.app')))

@section('title', $page_title)

@section('content')
<style>
    .job-details-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 32px 24px;
        margin-bottom: 32px;
    }
    .jobpost-img {
        width: 100%;
        border-radius: 12px;
        object-fit: cover;
        max-height: 350px;
        margin-bottom: 20px;
    }
    .list-tit h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #004B87;
        margin-bottom: 10px;
    }
    .dpan-des span {
        font-size: 1.1rem;
        color: #555;
    }
    .general-content h3 {
        font-size: 1.3rem;
        color: #004B87;
        margin-bottom: 10px;
    }
    .general-content p {
        color: #444;
        font-size: 1.05rem;
    }
    .agent-listbox {
        background: #f8f9fa;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        padding: 24px 18px;
        margin-bottom: 32px;
        text-align: center;
    }
    .box-img img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .agent-des h3 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #004B87;
        margin-bottom: 2px;
    }
    .agent-des h6 {
        color: #888;
        font-size: 1rem;
        margin-bottom: 0;
    }
    .agent-contact {
        background: #fff;
        border-radius: 10px;
        padding: 18px 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-top: 18px;
    }
    .agent-contact h5 {
        color: #004B87;
        font-size: 1.1rem;
        margin-bottom: 12px;
    }
    .btn-cont {
        background: #004B87;
        color: #fff;
        border-radius: 6px;
        padding: 8px 24px;
        font-weight: 600;
        border: none;
        transition: background 0.2s;
    }
    .btn-cont:hover {
        background: #003666;
        color: #fff;
    }
    .rent-listing {
        background: #f4f7fa;
        border-radius: 16px;
        padding: 32px 0 24px 0;
        margin-top: 50px;
        /* margin-bottom: 50px; */
    }
    .rental-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        padding: 18px 12px;
        margin: 10px;
        text-align: center;
        transition: box-shadow 0.2s;
        min-height: 350px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .rental-box:hover {
        box-shadow: 0 6px 24px rgba(0,75,135,0.13);
    }
    .pack-image-box {
        width: 100%;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
    .jobpost-image {
        max-width: 100%;
        max-height: 140px;
        border-radius: 10px;
        object-fit: cover;
    }
    .pack-rent-content h3 {
        font-size: 1.1rem;
        color: #004B87;
        font-weight: 600;
        margin-bottom: 6px;
    }
    .pack-rent-content p {
        color: #666;
        font-size: 0.98rem;
        margin-bottom: 4px;
    }
    .rent-foot .uni-btn {
        background: #F7A823;
        color: #fff;
        border-radius: 5px;
        padding: 6px 18px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
        margin-top: 10px;
    }
    .rent-foot .uni-btn:hover {
        background: #004B87;
        color: #fff;
    }
    .slick-slide {
        display: flex;
        justify-content: center;
        align-items: stretch;
        height: auto;
    }
    .slick-dots {
        bottom: -30px;
    }
    .listing-sec {
        margin-top: 50px;
        margin-bottom: 50px;
    }
    .carousel-img {
        margin: 0 auto;
        padding: 20px 0;
        width: 95%;
    }
    .related-projects-slider {
        margin: 0 auto;
        padding: 10px 0 40px 0;
        width: 90%;
    }
    .project-card {
        display: flex;
        flex-direction: column;
        height: 430px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        margin: 10px;
        overflow: hidden;
    }
    .project-image {
        width: 100%;
        height: 180px;
        overflow: hidden;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        background: #f4f4f4;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .project-image img, .no-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    .no-photo {
        background: #ccc;
        color: #888;
        font-size: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }
    .project-content {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        padding: 20px 24px 0 24px;
        min-height: 0;
    }
    .project-title {
        font-size: 1.1rem;
        color: #004B87;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .project-category {
        color: #888;
        font-size: 1rem;
        margin-bottom: 10px;
    }
    .project-desc {
        color: #444;
        font-size: 1rem;
        margin-bottom: 18px;
        flex: 1 1 auto;
        min-height: 48px;
        max-height: 48px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .project-btn-wrapper {
        margin-top: auto;
        padding-bottom: 20px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-primary {
        background: #cf8000;
        color: #fff;
        border-radius: 8px;
        padding: 10px 0;
        font-weight: 700;
        border: none;
        text-decoration: none;
        display: block;
        width: 90%;
        text-align: center;
        transition: background 0.2s;
    }
    .btn-primary:hover {
        background: #003666;
        color: #fff;
    }
    .slick-slide {
        display: flex;
        justify-content: center;
        align-items: stretch;
        height: auto;
    }
    .slick-dots {
        bottom: -30px;
    }
    .related-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 30px;
        color: #222;
    }
    body {
        background: #f6fafd;
    }
</style>

{{-- @if(!empty($banner->image))
<section class="inner-banner benefits-banner" style="background-image: url('{{asset('/admin/assets/images/banner') }}/{{ $banner->image }}');"> 
@else
<section class="inner-banner benefits-banner" style="background-image: url('{{asset('/admin/assets/images/images.png') }}');" style="width:100%">
@endif
  <div class="banner-wrapper position-relative z-1">
    <div class="container">
      <div class="row">
        @include('website.include.social-links') 
        <div class="col-lg-7 col-xl-6" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
          <div class="card">
            <div class="shape-1"></div>
              @if(isset($banner))
                <h1 class="hd-70">{{$banner->name}}</h1> 
              @endif
          </div>
        </div>
      </div>
      <a href="#sec-1" class="">
        <div class="top-to-bottom">
          <i class="fa-solid fa-arrow-down"></i>
        </div>
      </a>
    </div>
  </div>
</section> --}}

<section class="listing-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="job-details-card">
                    <div class="listing-slide-img">
                        @if($project->image)
                        <img src="{{ asset('/admin/assets/images/projects/' . $project->image) }}" class="jobpost-img" alt="">
                        @else
                        <img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}" class="jobpost-img">
                        @endif
                    </div>
                    <div class="list-tit">
                        <h3>{{ $project->name }}</h3>
                    </div>
                    <div class="dpan-des">
                        <span>{!! $project->description !!}</span>
                    </div>
                    <div class="general-content mt-5">
                        <h3>Description</h3>
                        <p>{!! $project->description !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="agent-listbox">
                    <div class="box-head">
                        <div class="box-img">
                            @if($contractor_detail && $contractor_detail->image)
                            <img src="{{ asset('/admin/assets/images/UserImage/' . $contractor_detail->image) }}" class="img-fluid">
                            @else
                            <img src="{{ asset('/admin/assets/images/Agents/no-photo1.jpg') }}" class="img-fluid">
                            @endif
                        </div>
                        <div class="agent-des">
                            @if($contractor_detail)
                            <h3>{{ $contractor_detail->name }} {{ $contractor_detail->last_name }}</h3>
                            <h6>{{ $contractor_detail->designation }}</h6>
                            @else
                            <p>Member details not available.</p>
                            @endif
                        </div>
                    </div>
                    <div class="agent-contact mt-3">
                        <h5>Contact To EPC Developer</h5>
                        <form action="{{ route('client_contact.store') }}" id="contactForm" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            @csrf
                            <div>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                                <input type="hidden" name="epc_developer_id" value="{{ $contractor_detail->id }}" required> 
                                <input type="hidden" name="project_id" value="{{ $project->id }}" required> 
                                <div>
                                    <div class="col-6">
                                        <input type="hidden" class="form-control mb-2" name="name" value="{{ Auth::user()->name }} {{ Auth::user()->last_name }}" placeholder="Name" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="hidden" class="form-control mb-2" name="email" value="{{ Auth::user()->email }}" placeholder="Email" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="hidden" class="form-control mb-2" name="phone" value="{{ Auth::user()->phone }}" placeholder="Phone" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" style="margin-bottom: 20px;" name="message" placeholder="Your Message" rows="4" required></textarea>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-cont">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                       {{--  @if(Session::has('message'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ Session::get('message') }}
                        </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related jobposts Section -->
<section class="rent-listing mt-5">
    <div class="container">
        <h2 class="text-center">Related Projects</h2>
        <div class="related-projects-slider">
            @foreach($related_projects as $related_project)
                <div class="project-card">
                    <div class="project-image">
                        @if($related_project->image)
                            <img src="{{ asset('/admin/assets/images/projects/' . $related_project->image) }}" alt="{{ $related_project->name }}">
                        @else
                            <div class="no-photo">No Photo</div>
                        @endif
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">{{ $related_project->name }}</h3>
                        <div class="project-category">
                            {{-- If you have a category name, show it here --}}
                            {{ $related_project->category_name ?? '' }}
                        </div>
                        <p class="project-desc">
                            {{ Str::words(strip_tags($related_project->description), 20, '...') }}
                        </p>
                        @php
                            $showReadMore = true;
                            if (Auth::check()) {
                                $user = Auth::user();
                                if ($user->hasRole('EPC Developer') || $user->package_id == 3) {
                                    if ($related_project->created_by == $user->id) {
                                        $showReadMore = false;
                                    }
                                }
                            }
                        @endphp
                        @if ($showReadMore)
                            <div class="project-btn-wrapper">
                                <a href="{{ route('project.details', $related_project->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection