@extends('layouts.admin')

@section('title')
    Categories
@endsection
@section('subtitle')
    Manage Categories
@endsection
@section('content')
    <div class="container mt-4">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
        </div>

        <div class="row">
            @foreach($categories as $category)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <img src="{{ $category->image == null ? 'https://dummyimage.com/300x300/cccccc/000000&text=' . $category->title : asset( "storage/".$category->image) }}" class="card-img-top" alt="Category Image">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $category->title }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
