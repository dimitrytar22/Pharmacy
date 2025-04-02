@extends('layouts.admin')

@section('title')
    Edit {{ $product->title }}
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow p-4">
            <h1 class="h3 mb-4">Edit Product: {{ $product->title }}</h1>
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Product Title</label>
                    <input type="text" name="title" id="title" value="{{ $product->title }}" class="form-control"
                           required>
                </div>
                @error('title')
                <x-input-error :messages="$message"/>
                @enderror

                <div class="mb-3">
                    <label for="editor" class="form-label">Product Instruction</label>
                    <textarea name="instruction" id="editor" class="form-control">{{$product->instruction}}</textarea>
                </div>
                @error('instruction')
                <x-input-error :messages="$message"/>
                @enderror

                <div class="mb-3">
                    <label class="form-label">Product Features</label>
                    <button type="button" id="add-feature-btn" class="btn btn-primary btn-sm ms-2">+</button>
                    <div id="features-container">
                        @foreach($product->features as $feature)
                            <div class="input-group mb-2 feature-item">
                                <input type="text" name="features[0][title]" class="form-control" placeholder="Title"
                                       value="{{$feature->title}}">
                                <input type="text" name="features[0][description]" class="form-control"
                                       placeholder="Description" value="{{$feature->description}}">
                                <button type="button" class="btn btn-danger remove-feature-btn">-</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control image-select"
                           accept="image/png, image/jpeg">

                    <div class="mt-3">
                        <p class="text-muted">Current Image:</p>
                        <img
                            src="{{ asset("storage/". $product->image ?? asset('/storage/images/products/default.jpg')) }}"
                            alt="Category Image" class="img-thumbnail w-25 selected-image">
                        <div class="alert alert-danger image-error" hidden role="alert">
                            <strong>Error!</strong> Invalid file type. Please upload an image.
                        </div>

                    </div>
                </div>
                @error('image')
                <x-input-error :messages="$message"/>
                @enderror

                <div class="mb-3">
                    <label for="category_id" class="form-label">Product Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <x-input-error :messages="$message"/>
                @enderror

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" id="price" value="{{$product->price}}" class="form-control"
                           required>
                </div>
                @error('price')
                <x-input-error :messages="$message"/>
                @enderror

                <div class="mb-3">
                    <label for="count" class="form-label">Count</label>
                    <input type="text" name="count" id="count" value="{{ $product->count }}" class="form-control"
                           required>
                </div>
                @error('count')
                <x-input-error :messages="$message"/>
                @enderror

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <button type="submit" form="delete-form" class="btn btn-danger">Delete</button>
                </div>
            </form>
            <form id="delete-form" action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
    @vite(['resources/js/pages/imageSelect.js', 'resources/js/pages/productEdit.js'])

@endsection
