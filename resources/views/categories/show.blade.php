@extends('layouts.main')

@section('title')
    {{$category->title}}
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="h2 font-weight-bold text-dark mb-4">{{ $category->title }}</h2>

        <div class="row">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <a href="{{ route('products.show', $product->id) }}">
                        <div class="card shadow-sm h-100">
                            <img src="{{ $product->image == null ? 'https://dummyimage.com/300x300/cccccc/000000&text=' . $product->title : asset('images/' . $product->image) }}"
                                 alt="Product Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $product->title }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
