@extends('layouts.admin')

@section('title', 'Create Product')

@section('subtitle', 'Manage Products')

@section('content')
    <div class="container mt-4">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header">
                <h2 class="h5">Create Product</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Product Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                               required>
                        @error('title')
                        <x-input-error :messages="$message"/>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="instruction" class="form-label">Product Instruction</label>
                        <textarea name="instruction" id="editor"
                                  class="form-control">{{ old('instruction') }}</textarea>
                        @error('instruction')
                        <x-input-error :messages="$message"/>
                        @enderror
                    </div>

                    <div id="features-container" class="mb-3">
                        <label class="form-label">Product Features</label>
                        <button type="button" id="add-feature-btn" class="btn btn-sm btn-primary">+</button>
                        <div class="feature-item d-flex gap-2 mt-2">
                            <input class="form-control" name="features[0][title]" type="text" placeholder="Title">
                            <input class="form-control" name="features[0][description]" type="text"
                                   placeholder="Description">
                            <button type="button" class="btn btn-sm btn-danger remove-feature-btn">-</button>
                        </div>
                        @error('features.*')

                        <x-input-error :messages="$message"/>

                        @enderror
                        @error('features')

                        <x-input-error :messages="$message"/>

                        @enderror
                        @error('features.*.*')

                        <x-input-error :messages="$message"/>

                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" accept="image/*" name="image" id="image" class="form-control">
                        <div class="mt-2">
                            <img id="preview" src="#" class="img-thumbnail d-none" width="100" height="100">
                        </div>
                        @error('image')

                        <x-input-error :messages="$message"/>

                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Product Category</label>
                        <select name="category_id" id="category_id" class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')

                        <x-input-error :messages="$message"/>

                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}"
                               required>
                        @error('price')

                        <x-input-error :messages="$message"/>

                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="count" class="form-label">Count</label>
                        <input type="text" name="count" id="count" class="form-control" value="{{ old('count') }}"
                               required>
                        @error('count')

                        <x-input-error :messages="$message"/>

                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-feature-btn').addEventListener('click', function () {
            let featureContainer = document.getElementById('features-container');
            let featureCount = featureContainer.querySelectorAll('.feature-item').length;
            let newFeature = document.createElement('div');
            newFeature.classList.add('feature-item', 'd-flex', 'gap-2', 'mt-2');
            newFeature.innerHTML = `
                <input class="form-control" name="features[\${featureCount}][title]" type="text" placeholder="Title">
                <input class="form-control" name="features[\${featureCount}][description]" type="text" placeholder="Description">
                <button type="button" class="btn btn-sm btn-danger remove-feature-btn">-</button>
            `;
            featureContainer.appendChild(newFeature);
        });

        document.getElementById('features-container').addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-feature-btn')) {
                event.target.parentElement.remove();
            }
        });

        document.getElementById('image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.add('d-none');
            }
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor')).catch(error => console.error(error));
    </script>
@endsection
