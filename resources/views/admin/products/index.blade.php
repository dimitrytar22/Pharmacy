@extends('layouts.admin')

@section('title', 'Products')

@section('subtitle', 'Manage Products')

    @section('content')
        <div class="container mt-4">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
            </div>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-decoration-none">
                            <div class="card shadow-sm h-100">
                                <img src="{{ !$product->image ? 'https://dummyimage.com/300x300/cccccc/000000&text=' . $product->title : asset($product->image) }}" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">{{ $product->title }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endsection

