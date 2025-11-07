@extends('layouts.app')

@section('content')
<!-- Hero Section (Full Width) -->
<section class="hero-section position-relative overflow-hidden; text-white d-flex align-items-center">
    <!-- Background Image (dapat diganti dengan elemen div dan background-image CSS untuk kontrol lebih) -->
    <div class="container position-relative z-1">
        <div class="row justify-content-center text-center py-5">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3 text-shadow">Welcome to PetShop</h1>
                <p class="lead mb-4 text-shadow">Quality products for your beloved pets</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
                        Explore Products
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-lg px-4 py-2 rounded-pill shadow-sm">
                        Shop by Category
                    </a>
                </div>
            </div>
        </div>
        <!-- Stats Section -->
        <div class="row text-center mt-5">
            <div class="col-md-4 mb-3">
                <h3 class="display-5 text-warning mb-1">500+</h3>
                <p class="text-light mb-0">Products Available</p>
            </div>
            <div class="col-md-4 mb-3">
                <h3 class="display-5 text-warning mb-1">4.5★</h3>
                <p class="text-light mb-0">Average Rating</p>
            </div>
            <div class="col-md-4 mb-3">
                <h3 class="display-5 text-warning mb-1">1000+</h3>
                <p class="text-light mb-0">Happy Customers</p>
            </div>
        </div>
    </div>
    
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Shop by Category</h2>
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
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Featured Products</h2>
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-lg-3 col-md-6">
                    <div class="card product-card h-100 border rounded-4 shadow-sm">
                        <div class="ratio ratio-1x1 overflow-hidden"> <!-- Square aspect ratio for product image -->
                            <img src="{{ $product->image ?: 'https://via.placeholder.com/300x300/2196F3/FFFFFF?text=' . urlencode($product->name) }}"
                                 class="card-img-top object-fit-cover" alt="{{ $product->name }}">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate fw-bold">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-success btn-sm rounded-circle" title="Add to Cart">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No featured products available.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    /* Optional: Add custom styles for the hero text shadow */
    .text-shadow {
        text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
    }

    /* Hover effect for category cards */
    .category-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Hover effect for product cards */
    .product-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1) !important;
    }

    /* Ensure images maintain aspect ratio */
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endsection