@extends('layouts.main')

@section('title')
    Products
@endsection


@section('content')
    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
                <a href="{{route('products.show', $product->id)}}">
                    <div class="bg-white rounded shadow hover:shadow-lg transition-shadow duration-300">
                        <img src="{{$product->image == null ? "https://dummyimage.com/300x300/cccccc/000000&text=$product->title" : asset("images/" . $product->image) }}"
                             alt="Placeholder Image" class="rounded-t w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-700">{{$product->title}}</h3>
                            <p class="text-lg font-bold text-blue-500 mt-3">{{$product->price}} ₴</p>
                            <button
                                class="mt-4 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition duration-300">
                                View Details
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
