{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">All Products</h1>

    <!-- Filter Section (Opsional) -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Filter by Category</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm {{ !request('category') ? 'active' : '' }}">All</a>
                        @foreach($categories as $category)
                            <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                               class="btn btn-outline-primary btn-sm {{ request('category') == $category->id ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
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
                <p class="text-muted">No products found.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection