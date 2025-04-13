@extends('layouts.admin')

@section('title')
    Create Category
@endsection

@section('subtitle')
    Manage Categories
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3>Create Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Category Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required>
                    </div>
                    @error('title')
                    <x-input-error :messages="$message"/>
                    @enderror

                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" accept="image/*" name="image" id="image" class="form-control">
                        <div class="mt-3">
                            <img id="preview" src="#" alt="Selected Image" class="img-thumbnail d-none" style="max-width: 150px; max-height: 150px;">
                        </div>
                    </div>

                    @error('image')
                    <x-input-error :messages="$message"/>
                    @enderror

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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
@endsection
