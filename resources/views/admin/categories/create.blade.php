@extends('layouts.admin')

@section('title')
    Create Category
@endsection

@section('subtitle')
    Manage Categories
@endsection

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-700 mb-6">Create Category</h1>
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data"
                  class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Category Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Category Image</label>
                    <input type="file" accept="image/*"  name="image" id="image"
                           class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border file:border-gray-300 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <div class="mt-4">
                        <img id="preview" src="#" alt="Selected Image" class="w-32 h-32 object-cover rounded hidden">
                    </div>
                </div>
                @error('image')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">{{$message}}</strong></div>
                @enderror


                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded-md shadow hover:bg-blue-600 transition">
                        Create
                    </button>
                </div>
            </form>
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
                    preview.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
            }
        });
    </script>

@endsection
