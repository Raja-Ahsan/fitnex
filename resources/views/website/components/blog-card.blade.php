<div class="blog-post-container">
    <h2 class="blog-post-title">{{ $blog->title }}</h2>
    <div class="blog-post-meta">
        <div class="blog-post-meta-left">
            <span><i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('d M Y') }}</span>
            <span><i class="fas fa-user"></i> {{ optional($blog->hasCreatedBy)->name ?? 'Admin' }}</span>
        </div>
        <div class="blog-post-meta-right">
            {{ optional($blog->hasCategory)->name ?? 'Fitness Blog' }}
        </div>
    </div>
    @if ($blog->post)
        <img src="{{ asset('/admin/assets/posts/' . $blog->post) }}" alt="{{ $blog->title }}" class="blog-post-image">
    @endif
    <div class="blog-post-content">
        @php
            $descriptionLength = strlen(strip_tags($blog->description));
            $fullText = strip_tags($blog->description);
        @endphp
        
        @if($descriptionLength > 200)
            <!-- First Level: Short Excerpt -->
            <div class="blog-excerpt" data-blog-id="{{ $blog->id }}">
                {!! Str::limit($fullText, 200, '...') !!}
            </div>
            
            <!-- Second Level: Medium Content (if text is longer than 600 chars) -->
            @if($descriptionLength > 600)
                <div class="blog-medium-content" data-blog-id="{{ $blog->id }}" style="display: none;">
                    {!! Str::limit($fullText, 600, '...') !!}
                </div>
            @endif
            
            <!-- Third Level: Full Content -->
            <div class="blog-full-content" data-blog-id="{{ $blog->id }}" style="display: none;">
                {!! $blog->description !!}
            </div>
            
            <div class="mt-4">
                @if($descriptionLength > 600)
                    <!-- Multi-level buttons for very long content -->
                    <button class="btn btn-primary btn-sm read-more-btn" data-blog-id="{{ $blog->id }}" data-level="1">Read More</button>
                    <button class="btn btn-primary btn-sm read-more-btn" data-blog-id="{{ $blog->id }}" data-level="2" style="display: none;">Read More</button>
                    <button class="btn btn-secondary btn-sm read-less-btn" data-blog-id="{{ $blog->id }}" data-level="2" style="display: none;">Read Less</button>
                    <button class="btn btn-secondary btn-sm read-less-btn" data-blog-id="{{ $blog->id }}" data-level="1" style="display: none;">Read Less</button>
                @else
                    <!-- Single level buttons for medium content -->
                    <button class="btn btn-primary btn-sm read-more-btn" data-blog-id="{{ $blog->id }}" data-level="1">Read More</button>
                    <button class="btn btn-secondary btn-sm read-less-btn" data-blog-id="{{ $blog->id }}" data-level="1" style="display: none;">Read Less</button>
                @endif
            </div>
        @else
            <div class="blog-full-content">
                {!! $blog->description !!}
            </div>
        @endif
    </div>
</div>