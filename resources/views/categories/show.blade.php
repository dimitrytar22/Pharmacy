@extends('layouts.main')

@section('title')
    {{$category->title}}
@endsection

@section('content')
    @vite('resources/js/pages/addToCart.js')
    <div class="container mt-5">
        <h2 class="h2 font-weight-bold text-dark mb-4">{{ $category->title }}</h2>

        <div class="row product-card">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm h-100 d-flex flex-column">
                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none product-image-url">
                            <img src="{{ $product->image == null ? 'https://dummyimage.com/300x300/cccccc/000000&text=' . $product->title : asset('images/' . $product->image) }}"
                                 alt="Product Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body text-center">
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                <h5 class="product-title text-dark">{{ $product->title }}</h5>
                            </a>
                            <p class="product-price">{{$product->price}} ₴</p>
                            <button class="btn btn-sm btn-primary mt-2 add-to-cart">
                                Add to cart
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
