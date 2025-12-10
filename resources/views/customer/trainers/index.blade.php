@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Find Your Perfect Trainer</h2>
                <p class="text-muted">Browse our certified trainers and book your session</p>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('customer.trainers.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search"
                            placeholder="Trainer name or specialty" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="min_price" class="form-label">Min Price ($)</label>
                        <input type="number" class="form-control" id="min_price" name="min_price" placeholder="0"
                            value="{{ request('min_price') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="max_price" class="form-label">Max Price ($)</label>
                        <input type="number" class="form-control" id="max_price" name="max_price" placeholder="200"
                            value="{{ request('max_price') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Trainers Grid -->
        @if($trainers->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> No trainers found. Try adjusting your search criteria.
            </div>
        @else
            <div class="row">
                @foreach($trainers as $trainer)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px; font-size: 24px;">
                                        {{ strtoupper(substr($trainer->name, 0, 1)) }}
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $trainer->name }}</h5>
                                        <small class="text-muted">{{ $trainer->designation }}</small>
                                    </div>
                                </div>

                                <p class="text-muted">
                                    {{ \Illuminate\Support\Str::limit($trainer->description, 100) }}
                                </p>

                                <div class="mb-3">
                                    <strong>Starting from:</strong>
                                    <span class="text-success fs-5">${{ number_format($trainer->price, 2) }}</span>
                                    <small class="text-muted">/ session</small>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-check"></i>
                                        {{ $trainer->availabilities->count() }} days available
                                    </small>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="{{ route('customer.trainers.show', $trainer->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-user"></i> View Profile
                                    </a>
                                    <a href="{{ route('customer.schedule', $trainer->id) }}" class="btn btn-primary">
                                        <i class="fas fa-calendar-alt"></i> Book Session
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $trainers->links() }}
            </div>
        @endif
    </div>
@endsection