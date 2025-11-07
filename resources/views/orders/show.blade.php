{{-- resources/views/orders/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Order Details #{{ $order->id }}</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Order Items</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($order->orderItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{ $item->product->name }}</div>
                                    <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <span>Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                    <strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong>
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
                    <h5>Order Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between">
                            <strong>Order ID:</strong>
                            <span>{{ $order->id }}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <strong>Date:</strong>
                            <span>{{ $order->created_at->format('d M Y H:i') }}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </li>
                        <hr>
                        <li class="d-flex justify-content-between">
                            <strong>Total:</strong>
                            <strong class="text-success">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection