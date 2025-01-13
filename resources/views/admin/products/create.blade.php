@extends('layouts.admin')

@section('title')
    Create Product
@endsection

@section('subtitle')
    Manage Products
@endsection

@section('content')
    <div class="container mx-auto mt-8">
        @if(session()->has('success'))
            <div class="container mx-auto mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                     role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{session('success')}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1 1 0 01-1.414 0L10 11.914l-2.934 2.935a1 1 0 11-1.414-1.414l2.935-2.934-2.935-2.934a1 1 0 011.414-1.414L10 9.086l2.934-2.935a1 1 0 011.414 1.414L11.414 10l2.935 2.934a1 1 0 010 1.415z"/>
            </svg>
        </span>
                </div>
            </div>

        @endif
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-700 mb-6">Create Product</h1>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                  class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Product Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>
                @error('title')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">{{$message}}</strong></div>
                @enderror

                <div>
                    <label for="instruction" class="block text-sm font-medium text-gray-700">Product Instruction</label>
                    <textarea name="instruction" id="editor">{{old('instruction')}}</textarea>
                </div>
                @error('instruction')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">{{$message}}</strong></div>
                @enderror


                <div id="features-container" class="space-y-4">
                    <!-- Header with Label and Add Button -->
                    <div class="flex items-center">
                        <label for="features" class="block text-sm font-medium text-gray-700">Product Features</label>
                        <button type="button" id="add-feature-btn"
                                class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            +
                        </button>
                    </div>

                    <div class="feature-item">
                        <input
                            class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            name="features[0][title]" type="text" placeholder="Title">
                        <input
                            class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            name="features[0][description]" type="text" placeholder="Description">
                        <button type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 remove-feature-btn">
                            -
                        </button>
                    </div>
                </div>


                @error('features')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">{{$message}}</strong></div>
                @enderror


                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                    <input type="file" accept="image/*" name="image" id="image"
                           class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border file:border-gray-300 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <div class="mt-4">
                        <img id="preview" src="#" alt="Selected Image" class="w-32 h-32 object-cover rounded hidden">
                    </div>
                </div>
                @error('image')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">{{$message}}</strong></div>
                @enderror


                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Product Category</label>
                    <select name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">{{$message}}</strong></div>
                @enderror


                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                    <input type="text" name="price" id="price" value="{{ old('price') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>
                @error('price')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">{{$message}}</strong></div>
                @enderror
                <div>
                    <label for="count" class="block text-sm font-medium text-gray-700">Count:</label>
                    <input type="text" name="count" id="count" value="{{ old('count') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>
                @error('count')
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
        let featureCount = 1;

        let featuresContainer = document.getElementById('features-container');
        let addFeatureBtn = document.getElementById('add-feature-btn');

        addFeatureBtn.addEventListener('click', () => {
            const newFeature = document.createElement('div');
            newFeature.classList.add('feature-item');
            newFeature.innerHTML = `
            <input class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="features[${featureCount}][title]" type="text" placeholder="Title">
            <input class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="features[${featureCount}][description]" type="text" placeholder="Description">
            <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 remove-feature-btn">-</button>
        `;
            featuresContainer.appendChild(newFeature);

            featureCount++;
        });


        featuresContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-feature-btn')) {
                const featureItem = event.target.closest('.feature-item');
                featureItem.remove();
            }
        });
    </script>
    <script>
        document.querySelector('[role="button"]').addEventListener('click', function () {
            this.closest('div[role="alert"]').remove();
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
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
