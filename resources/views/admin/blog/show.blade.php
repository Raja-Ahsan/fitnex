@extends('layouts.admin.app')
@section('title', $page_title)

@push('css')
<style>
    .content-wrapper {
        background-color: #f4f6f9;
    }
    .blog-post-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-top: 20px;
        border: 1px solid #eee;
    }
    .blog-post-image {
        width: 100%;
        height: 400px;
        object-fit: contain;
        background-color: #f4f6f9;
    }
    .blog-post-content {
        padding: 40px;
    }
    .blog-post-title {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .blog-post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    .blog-post-meta span {
        display: flex;
        align-items: center;
    }
    .blog-post-meta i {
        margin-right: 8px;
        color: #3c8dbc;
    }
    .blog-post-body {
        font-size: 16px;
        line-height: 1.8;
        color: #333;
    }
    .blog-post-meta .label {
        margin-left: 5px;
    }
</style>
@endpush

@section('content')
<input type="hidden" id="page_url" value="{{ route('blog.index') }}">
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('blog.index') }}" class="btn btn-primary btn-sm">View All</a>
		<a href="{{ route('blog.edit', $model->id) }}" class="btn btn-info btn-sm">Edit</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="blog-post-container">
                @if($model->post)
                    <img src="{{ asset('/admin/assets/posts/' . $model->post) }}" alt="{{ $model->title }}" class="blog-post-image">
                @endif
				<div class="blog-post-content">
					<h1 class="blog-post-title">{{ $model->title }}</h1>
					<div class="blog-post-meta">
                        <span>
                            <i class="fa fa-user"></i>
                            {{ optional($model->hasCreatedBy)->name ?? 'N/A' }}
                        </span>
                        <span>
                            <i class="fa fa-folder-open"></i>
                            {{ optional($model->hasCategory)->name ?? 'Uncategorized' }}
                        </span>
                        <span>
                            <i class="fa fa-calendar"></i>
                            {{ $model->created_at->format('F d, Y') }}
                        </span>
                        <span>
                            <i class="fa fa-eye"></i> Status:
                             @if($model->status)
                                <span class="label label-success">Published</span>
                            @else
                                <span class="label label-warning">Draft</span>
                            @endif
                        </span>
					</div>

					<div class="blog-post-body">
						{!! $model->description !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
