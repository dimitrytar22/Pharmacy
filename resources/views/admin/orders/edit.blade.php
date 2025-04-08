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
                                <input type="text" class="form-control w-25" name="prompt"
                                       id="product-search-prompt-field" placeholder="Search for products">
                                <span id="search-status" class="ms-2 text-muted"></span>
                            </div>
                        </div>


                        <div class="list-group">

                            <div class="new-products">

                            </div>

                            <div class="existing-products">
                                @foreach($order->products as $product)
                                    <div
                                        class="list-group-item d-flex justify-content-between align-items-center border mb-2">
                                        <span>{{ $product->title }}</span>
                                        <span class="badge bg-secondary">Amount: {{ $product->pivot->amount }}</span>
                                        <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        @error('product_ids')
                        <x-input-error :messages="$message"/>
                        @enderror
                        @error('product_ids.*')
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
                                    {{ $order->discount->id === $discount->id ? 'selected' : '' }}>
                                    {{ $discount->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('discount_id')
                        <x-input-error :messages="$message"/>
                        @enderror
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
                <form id="search-form" action="{{route('admin.orders.search')}}">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/pages/orderEdit.js')
@endsection
