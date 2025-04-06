@extends('layouts.main')
@section('title')
    Orders
@endsection
@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Orders</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left">Order ID</th>
                    <th class="py-3 px-4 text-left">Created</th>
                    <th class="py-3 px-4 text-left">Products</th>
                    <th class="py-3 px-4 text-left">Total</th>
                    <th class="py-3 px-4 text-left">Paid at</th>
                    <th class="py-3 px-4 text-left">Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $order->id }}</td>
                        <td class="py-3 px-4">{{ $order->created_at }}</td>
                        <td class="py-3 px-4">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($order->products as $product)
                                    <li>
                                        <b>{{ $product->title }}</b> {{\Illuminate\Support\Str::substr($product->instruction, 0, 25)}}
                                        ... ( x{{ $product->pivot->amount }} )
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="py-3 px-4">{{ $order->totalSum() }}$</td>

                        <td class="py-3 px-4 text-left">{{ $order->finished_at ?? "Not paid" }}</td>

                        <td class="py-3 px-4 text-left">
                            <a href="{{ route('profile.orders.show', $order->id) }}" class="btn btn-primary">
                                Details
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
