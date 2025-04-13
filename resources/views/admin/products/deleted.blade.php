@extends('layouts.admin')

@section('title')
    Deleted Products
@endsection
@section('subtitle')
    Manage Products
@endsection

@section('content')
    <div class="container mt-4">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="row">
            @forelse($deletedProducts as $deletedProduct)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card shadow-sm h-100">
                            <img src="{{ !$deletedProduct->image ? asset('images/defaults/products/default.jpg') : asset("storage/".$deletedProduct->image) }}" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $deletedProduct->title }}</h5>
                                <div class="mb-3">
                                    <a href="{{ route('admin.products.restore', $deletedProduct->id) }}"
                                       class="btn btn-primary">Restore</a>
                                </div>
                                <div class="md-3">
                                    <form
                                          action="{{route('admin.products.forceDestroy', $deletedProduct->id)}}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete permanently
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                </div>
            @empty
                No Products
            @endforelse
        </div>

        <div class="mt-3">
            {{ $deletedProducts->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

