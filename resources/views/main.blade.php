@extends('layouts.main')

@section('title')
Your Health Partner
@endsection

@section('content')

    <section id="hero" class="bg-blue-500 text-white py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold">Your Trusted Partner in Health</h2>
            <p class="mt-4 text-lg">Explore a wide range of medicines, healthcare products, and expert services all in
                one
                place.</p>
            <a href="{{route("categories.index")}}"
               class="mt-6 inline-block bg-white text-blue-500 font-bold px-6 py-3 rounded hover:bg-gray-100">Shop
                Now</a>
        </div>
    </section>

    <section id="products" class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold">Our Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
                @foreach($categories as $category)
                    <a href="{{route('categories.show', $category->id)}}">
                        <div class="bg-white shadow rounded p-4">
                            <img
                                src="{{$category->image == null  ? "https://dummyimage.com/300x300/cccccc/000000&text=$category->title" : asset('images/'.$category->image)}}"
                                alt="Medicine 1" class="h-80 w-full object-cover rounded">
                            <h3 class="mt-4 font-semibold">{{$category->title}}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="services" class="bg-gray-100 py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold">Our Services</h2>
            <ul class="mt-8 space-y-4">
                <li class="text-lg">Prescription Fulfillment</li>
                <li class="text-lg">Health Consultations</li>
                <li class="text-lg">Vaccination Services</li>
                <li class="text-lg">Online Ordering & Delivery</li>
            </ul>
        </div>
    </section>

    <section id="about" class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold">About Us</h2>
            <p class="mt-4 text-lg">At Pharmacy, we are dedicated to providing exceptional healthcare services and
                products.
                With years of experience, we strive to support our community's health and well-being.</p>
        </div>
    </section>


    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Pharmacy. All Rights Reserved.</p>
            <ul class="flex justify-center space-x-4 mt-4">
                <li><a href="#" class="hover:text-blue-400">Facebook</a></li>
                <li><a href="#" class="hover:text-blue-400">Twitter</a></li>
                <li><a href="#" class="hover:text-blue-400">Instagram</a></li>
            </ul>
        </div>
    </footer>

@endsection
