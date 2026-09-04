@if($count > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 lg:gap-7">
        @foreach ($trainers as $trainer)
            @include('website.partials.trainer-match-card', ['trainer' => $trainer, 'categories' => $categories])
        @endforeach
    </div>
@endif
