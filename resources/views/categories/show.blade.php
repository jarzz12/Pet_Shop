{{-- resources/views/categories/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">{{ $category->name }}</h1>

    <p>{{ $category->description }}</p>

    <h2>Products in this Category</h2>

    @if($products->isEmpty())
        <p class="text-muted">No products found in this category.</p>
    @else
        <div class="row g-4">
            @foreach($products as $product)
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
            @endforeach
        </div>

        {{ $products->links() }} <!-- Tampilkan pagination jika menggunakan paginate -->
    @endif
</div>
@endsection