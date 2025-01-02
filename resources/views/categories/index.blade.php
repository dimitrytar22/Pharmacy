@extends('layouts.main')

@section('title')
    Categories
@endsection

@section('content')
    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->id) }}">
                    <div class="bg-white rounded shadow hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ $category->image == null ? 'https://dummyimage.com/300x300/cccccc/000000&text=' . $category->title : asset('images/' . $category->image) }}"
                             alt="Category Image" class="rounded-t w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-700">{{ $category->title }}</h3>

                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
