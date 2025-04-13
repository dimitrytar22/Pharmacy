@extends('layouts.admin')

@section('title')
    Create
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Create Order</h5>
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
                    <p class="form-text">{{$user->name }}</p>
                </div>

                <form id="edit-order-form" action="{{ route('admin.users.orders.store', $user->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="payment_method_id" class="form-label">Payment Method</label>
                        <select name="payment_method_id" id="payment_method_id" class="form-select">
                            <option value="">Select payment method</option>
                            @foreach($paymentMethods as $paymentMethod)
                                <option
                                    value="{{ $paymentMethod->id }}">
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
                                    value="{{ $discount->id }}">
                                    {{ $discount->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('discount_id')
                        <x-input-error :messages="$message"/>
                        @enderror

                        <div class="mb-3 mt-3">
                            <label for="paid_at" class="form-label">Paid At</label>
                            <input type="datetime-local" id="paid_at" name="paid_at" value=""
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


                <form id="search-form" action="{{route('admin.products.search')}}">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/pages/orderForm.js')
@endsection
