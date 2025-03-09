@extends('layouts.admin')

@section('title')
    Edit {{ $category->title }}
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Category: {{ $category->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Category Title</label>
                        <input type="text" name="title" id="title" value="{{ $category->title }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if($category->image)
                            <div class="mt-3">
                                <p class="text-muted">Current Image:</p>
                                <img src="{{ asset('images/' . $category->image) }}" alt="Category Image" class="img-thumbnail w-25">
                            </div>
                        @endif
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
