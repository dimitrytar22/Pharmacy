@extends('layouts.admin')

@section('title')
    Deleted Categories
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
        <h2 class="mb-4">Deleted Categories</h2>


        <div class="row">

            @forelse($deletedCategories as $deletedCategory)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm">

                        <img
                            src="{{ $deletedCategory->image == null ? asset('images/defaults/categories/default.jpg') : asset( "storage/".$deletedCategory->image) }}"
                            class="card-img-top" alt="Category Image">
                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ $deletedCategory->title }}</h5>
                            <div class="mb-3">
                                <a href="{{ route('admin.categories.restore', $deletedCategory->id) }}"
                                   class="btn btn-primary">Restore</a>
                            </div>
                            <div class="md-3">
                                <form id="permanent-delete"
                                      action="{{route('admin.categories.forceDestroy', $deletedCategory->id)}}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button form="permanent-delete" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete permanently
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                No categories
            @endforelse
        </div>
    </div>
@endsection
