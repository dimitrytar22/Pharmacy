@extends('layouts.main')

@section('title')
    Categories
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <a href="{{ route('categories.show', $category->id) }}">
                        <div class="card shadow-sm h-100">
                            <img src="{{ $category->image == null ? 'https://dummyimage.com/300x300/cccccc/000000&text=' . $category->title : asset('storage/' . $category->image) }}"
                                 alt="Category Image" class="card-img-top" style="height: 200px; object-fit: cover;">
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
