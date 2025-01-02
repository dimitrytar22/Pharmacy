@extends('layouts.admin')

@section('title')
    Categories
@endsection

@section('content')
    <div class="container mx-auto mt-8">
        @if(session()->has('success'))
            <div class="container mx-auto mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                     role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">The category has been successfully updated.</span>
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
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($categories as $category)
                <a href="{{ route('admin.categories.edit', $category->id) }}">
                    <div class="bg-white rounded shadow hover:shadow-lg transition-shadow duration-300">
                        <img
                            src="{{ $category->image == null ? 'https://dummyimage.com/300x300/cccccc/000000&text=' . $category->title : asset('images/' . $category->image) }}"
                            alt="Category Image" class="rounded-t w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-700">{{ $category->title }}</h3>

                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <script>
        document.querySelector('[role="button"]').addEventListener('click', function () {
            this.closest('div[role="alert"]').remove();
        });
    </script>
@endsection
