{{-- resources/views/orders/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Checkout</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div class="text-center">
            <p class="text-muted">Your cart is empty. <a href="{{ route('products.index') }}">Continue shopping</a></p>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($cartItems as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $item->product->name }}</div>
                                        <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <span>Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                        <strong>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</strong>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Total</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between">
                                <strong>Subtotal:</strong>
                                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                            </li>
                            <!-- Misalnya, tambahkan biaya pengiriman di sini jika ada -->
                            <!--
                            <li class="d-flex justify-content-between">
                                <span>Shipping:</span>
                                <span>Rp 0</span>
                            </li>
                            -->
                            <hr>
                            <li class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong class="text-success">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                            </li>
                        </ul>
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <!-- Tambahkan form input untuk alamat, dll di sini jika diperlukan -->
                            <button type="submit" class="btn btn-success w-100">Place Order</button>
                        </form>
                        <a href="{{ route('cart.index') }}" class="btn btn-link w-100">Back to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection