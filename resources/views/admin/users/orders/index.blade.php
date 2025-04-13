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

        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            <form method="GET" action="{{ route('admin.users.orders.index', $user) }}" class="d-flex flex-wrap gap-2">
                <div>
                    <select name="status_id" class="form-select">
                        <option value="">All Statuses</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" @selected(request('status_id') == $status->id)>
                                {{ $status->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="payment_method_id" class="form-select">
                        <option value="">All Payment Methods</option>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}" @selected(request('payment_method_id') == $method->id)>
                                {{ $method->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="discount_id" class="form-select">
                        <option value="">All Discounts</option>
                        @foreach($discounts as $discount)
                            <option value="{{ $discount->id }}" @selected(request('discount_id') == $discount->id)>
                                {{ $discount->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-secondary">Filter</button>
            </form>

            <a href="{{ route('admin.users.orders.create', $user) }}" class="btn btn-primary px-4">Add Order</a>
        </div>

        <div class="row g-4">
            @forelse($orders as $order)
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
                                <div class="small text-secondary mb-1">Status</div>
                                <div class="mb-2">{{ $order->status->title }}</div>
                                <div class="small text-secondary mb-1">Paid At</div>
                                <div>{{ $order->paid_at ?? 'Not paid' }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm text-center py-5">
                        <div class="card-body">
                            <h5 class="text-secondary mb-0">No orders found</h5>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

