@extends('layouts.admin')

@section('title')
    Orders
@endsection

@section('subtitle')
    Manage Orders
@endsection

@section('content')
    <div class="container py-4">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('admin.users.orders.create', $user) }}" class="btn btn-primary px-4">Add Order</a>
        </div>

        <div class="row g-4">
            @foreach($orders as $order)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title text-dark mb-3">Order #{{ $order->id }}</h5>
                                <div class="small text-secondary mb-1">User</div>
                                <div class="mb-2">{{ $order->user->name }}</div>
                                <div class="small text-secondary mb-1">Payment</div>
                                <div class="mb-2">{{ $order->paymentMethod->title ?? 'Not selected' }}</div>
                                <div class="small text-secondary mb-1">Discount</div>
                                <div class="mb-2">{{ $order->discount->title ?? 'Not applied' }}</div>
                                <div class="small text-secondary mb-1">Finished At</div>
                                <div>{{ $order->finished_at ?? 'Not finished' }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
