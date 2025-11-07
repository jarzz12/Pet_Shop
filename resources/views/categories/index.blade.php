{{-- resources/views/categories/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">All Categories</h1>

    <div class="row g-4">
        @forelse($categories as $category)
            <div class="col-lg-3 col-md-6">
                <div class="card category-card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="ratio ratio-4x3 overflow-hidden"> <!-- Maintain aspect ratio -->
                        <img src="{{ $category->image ?: 'https://via.placeholder.com/300x200/4CAF50/FFFFFF?text=' . urlencode($category->name) }}"
                             class="card-img-top object-fit-cover" alt="{{ $category->name }}">
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold">{{ $category->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($category->description, 100) }}</p>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary btn-sm rounded-pill px-4">
                            Explore Category
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No categories available.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection