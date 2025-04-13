@extends('layouts.admin')

@section('title')
    Edit {{ $order->id }}
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Order: {{ $order->id }}</h5>
            </div>
            <div class="card-body">
                @if (session()->has('error'))
                    <div class="mb-3">
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label fw-bold">User Name:</label>
                    <p class="form-text">{{ $order->user->name }}</p>
                </div>

                <form id="edit-order-form" action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="payment_method_id" class="form-label">Payment Method</label>
                        <select name="payment_method_id" id="payment_method_id" class="form-select">
                            <option value="">Select payment method</option>
                            @foreach($paymentMethods as $paymentMethod)
                                <option
                                    value="{{ $paymentMethod->id }}"
                                    {{ $order->paymentMethod->id ?? null === $paymentMethod->id ? 'selected' : '' }}>
                                    {{ $paymentMethod->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_method_id')
                        <x-input-error :messages="$message"/>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Products</label>
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control w-25"
                                       id="product-search-prompt-field" placeholder="Search for products">
                                <span id="search-status" class="ms-2 text-muted"></span>
                            </div>
                        </div>


                        <div class="list-group">
                            <div class="section-header">
                                <h5 class="mb-3">Search Results</h5>
                            </div>
                            <div class="products-search-list">

                            </div>


                            <div class="order-products">
                                <div class="section-header">
                                    <h5 class="mb-3">Order Products</h5>
                                </div>
                                @foreach($order->products as $product)
                                    <div
                                        class="list-group-item border mb-2 product d-flex justify-content-between align-items-center"
                                        data-id="{{ $product->id }}">
                                        <div class="flex-grow-1 me-3">
                                            <strong>{{ $product->title }}</strong>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="number" class="form-control form-control-sm product-amount"
                                                   name="products[{{ $product->id }}][amount]"
                                                   value="{{ $product->pivot->amount }}" min="1"
                                                   max="{{ $product->count }}" style="width: 80px;">
                                            <span
                                                class="badge bg-secondary">Available: {{ $product->count }}</span>
                                            <span class="text-danger remove-product-button" data-id="{{ $product->id }}"
                                                  style="cursor: pointer;">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        </div>
                                        <input type="hidden" name="products[{{ $product->id }}][id]"
                                               value="{{ $product->id }}">
                                    </div>
                                @endforeach

                            </div>

                        </div>

                        @error('products')
                        <x-input-error :messages="$message"/>
                        @enderror
                        @error('products.*')
                        <x-input-error :messages="$message"/>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="discount_id" class="form-label">Discount</label>
                        <select name="discount_id" id="discount_id" class="form-select">
                            <option value="">Select discount</option>
                            @foreach($discounts as $discount)
                                <option
                                    value="{{ $discount->id }}"
                                    {{ $order->discount->id ?? null === $discount->id ? 'selected' : '' }}>
                                    {{ $discount->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('discount_id')
                        <x-input-error :messages="$message"/>
                        @enderror

                        <label for="status_id" class="form-label">Status</label>
                        <select name="status_id" id="status_id" class="form-select">
                            <option value="">Select status</option>
                            @foreach($statuses as $status)
                                <option
                                    value="{{ $status->id }}"
                                    {{ $order->status->id ?? null === $status->id ? 'selected' : '' }}>
                                    {{ $status->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_id')
                        <x-input-error :messages="$message"/>
                        @enderror

                        <div class="mb-3 mt-3">
                            <label for="paid_at" class="form-label">Paid At</label>
                            <input type="datetime-local" id="paid_at" name="paid_at"
                                   value="{{ $order->paid_at ? \Carbon\Carbon::parse($order->paid_at)->format('Y-m-d\TH:i') : '' }}"
                                   class="form-control" placeholder="Select date and time">
                            @error('paid_at')
                            <x-input-error :messages="$message"/>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <button type="button" class="btn btn-danger confirm-delete-button">Delete</button>
                    </div>
                </form>

                <form id="delete-form" action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
                <form id="search-form" action="{{route('admin.products.search')}}">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/pages/orderForm.js')
@endsection
