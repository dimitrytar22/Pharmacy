@extends('layouts.main')
@section('title')
    Order ID: {{ $order->id }}
@endsection
@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Order №{{ $order->id }}</h1>

        <div class="mb-4">
            <p><strong>Created at:</strong> {{ $order->created_at }}</p>
            <p><strong>Status:</strong> {{ $order->paid_at ? 'Paid at ' . $order->paid_at : 'Not paid' }}</p>
            <p><strong>Total:</strong> {{ $order->totalSum() }}$</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold mb-3">Products</h2>
            <ul class="list-disc list-inside space-y-2">
                @foreach($order->products as $product)
                    <li>
                        <span class="font-semibold">{{ $product->title }}</span>
                        — {{ \Illuminate\Support\Str::limit($product->instruction, 60) }}
                        (x{{ $product->pivot->amount }})
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
