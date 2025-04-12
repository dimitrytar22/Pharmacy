@extends('layouts.admin')

@section('title')
    Order №{{ $order->id }}
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Order Details: №{{ $order->id }}</h5>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label fw-bold">User:</label>
                    <p class="form-text mb-0">{{ $order->user->name }} (ID: {{ $order->user->id }})</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Payment Method:</label>
                    <p class="form-text mb-0">{{ $order->paymentMethod->title ?? 'Not selected' }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Discount:</label>
                    <p class="form-text mb-0">{{ $order->discount->title ?? 'Not applied' }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Finished At:</label>
                    <p class="form-text mb-0">
                        {{ $order->finished_at ? \Carbon\Carbon::parse($order->finished_at)->format('Y-m-d H:i') : 'Not finished' }}
                    </p>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Products:</label>
                    @if ($order->products->count())
                        <ul class="list-group">
                            @foreach ($order->products as $product)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $product->title }}</strong>
                                        <span class="text-muted ms-2">x{{ $product->pivot->amount }}</span>
                                    </div>
                                    <span class="badge bg-secondary">Available: {{ $product->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="form-text">No products in this order.</p>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning">Edit Order</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this order?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Order</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
