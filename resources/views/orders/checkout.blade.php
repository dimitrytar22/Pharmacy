@extends('layouts.main')

@section('title')
    Order Checkout
@endsection

@section('content')
    <div class="container">
        <h1>Order Details #{{ $order->id }}</h1>

        <div class="card mb-3">
            <div class="card-header">Customer</div>
            <div class="card-body">
                @if($order->user)
                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                @else
                    <p class="text-muted">No customer specified</p>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Order Items</div>
            <div class="card-body">
                @if($order->products)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td><a href="{{route('products.show', $product->id)}}">{{ $product->title }}</a>
                                    </td>
                                    <td><img style="width: 100px" src="{{asset('storage/'.$product->image)}}"
                                             alt="{{basename($product->image)}}"></td>
                                    <td>{{ Str::limit($product->instruction, 50) }}</td>
                                    <td> {{($product->pivot->amount) }}</td>
                                    <td>{{ number_format($product->price, 2) }} $</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">No products in order</div>
                @endif
            </div>
        </div>

        <div class="card mb-3 border-success">
            <div class="card-header bg-success text-white">
                Discount
            </div>
            <div class="card-body">
                @if($order->discount)
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tag text-success me-2 fs-4"></i>
                        <div>
                            <span class="mb-0 text-success">{{ $order->discount->title }}</span>
                            <span class="badge bg-light text-success fs-6">
                        -{{ $order->discount->size }}%
                    </span>
                        </div>
                    </div>
                @else
                    <p class="text-muted mb-0">
                        <i class="far fa-times-circle me-1"></i>
                        No discount applied
                    </p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">Order Summary</div>
            <div class="card-body">
                <p><strong>Created at:</strong> {{ $order->created_at }}</p>
                <p><strong>Full price:</strong> {{ $order->totalSum() }} $</p>
                @if($order->discount)
                    <p><strong>Price with discount:</strong> {{ $order->totalSum($order->discount->size) }} $</p>
                @endif

            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">Payment</div>
            <div class="card-body text-center">
                @error('sum')
                <x-input-error :messages="$message"/>
                @enderror
                <form action="{{route('orders.checkout.pay', $order->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="sum" value="{{$order->totalSum($order->discount->size ?? null)}}">

                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-credit-card me-2"></i> Pay Now
                    </button>
                </form>
                <p class="text-muted mt-2 mb-0">Total amount: @if($order->discount)
                        <s>{{ number_format($order->totalSum(), 2) }}
                            $</s>  {{ $order->totalSum($order->discount->size) }} $</p>
                @else
                    {{ number_format($order->totalSum(), 2) }}$</p>

                @endif

            </div>
        </div>
    </div>
@endsection
