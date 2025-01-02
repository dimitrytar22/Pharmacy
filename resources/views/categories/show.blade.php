@extends('layouts.main')

@section('title')
    {{$category->title}}
@endsection

@section('content')
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">{{ $category->title }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product->id) }}">
                    <div class="bg-white rounded shadow hover:shadow-lg transition-shadow duration-300">
                        <img
                            src="{{ $product->image == null ? 'https://dummyimage.com/300x300/cccccc/000000&text=' . $product->title : asset('images/' . $product->image) }}"
                            alt="Category Image" class="rounded-t w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-700">{{ $product->title }}</h3>

                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
