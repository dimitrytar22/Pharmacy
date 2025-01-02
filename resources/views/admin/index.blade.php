@extends('layouts.admin')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Welcome to the Admin Panel, {{ Auth::user()->name }}!</h1>

        <!-- Intro Text -->
        <div class="bg-white p-6 rounded shadow mb-8">
            <p class="text-lg text-gray-700">
                Here you can manage your store’s content, monitor user activity, and ensure smooth operation of the platform.
                If you encounter any issues, please reach out to the technical team.
            </p>
        </div>

        <!-- Overview Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Products -->
            <div class="bg-green-100 p-4 rounded shadow flex items-center">
                <img src="{{ asset('images/products.png') }}" alt="Products Icon" class="h-8 w-8 mr-3">
                <div>
                    <h2 class="text-lg font-bold text-gray-700">Total Products</h2>
                    <p class="text-3xl font-semibold text-green-500 mt-1">{{ $totalProducts }}</p>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="bg-yellow-100 p-4 rounded shadow flex items-center">
                <img src="{{ asset('images/categories.png') }}" alt="Categories Icon" class="h-8 w-8 mr-3">
                <div>
                    <h2 class="text-lg font-bold text-gray-700">Total Categories</h2>
                    <p class="text-3xl font-semibold text-yellow-500 mt-1">{{ $totalCategories }}</p>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-blue-100 p-4 rounded shadow flex items-center">
                <img src="{{ asset('images/orders.png') }}" alt="Orders Icon" class="h-8 w-8 mr-3">
                <div>
                    <h2 class="text-lg font-bold text-gray-700">Total Orders</h2>
                    <p class="text-3xl font-semibold text-blue-500 mt-1">1</p>
                </div>
            </div>
        </div>


        <!-- Recent Updates -->
        <div class="bg-white p-6 rounded shadow mb-8">
            <h2 class="text-xl font-bold text-gray-700 mb-4">Recent Updates</h2>
            <p class="text-gray-600">
                Stay informed about the latest changes on the platform. Below are some recent updates:
            </p>
            <ul class="list-disc pl-5 mt-4 text-gray-700">
{{--                @foreach($recentUpdates as $update)--}}
{{--                    <li>{{ $update }}</li>--}}
{{--                @endforeach--}}
            </ul>
        </div>

        <!-- Important Links -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold text-gray-700 mb-4">Quick Access</h2>
            <p class="text-gray-600 mb-4">Access key features quickly:</p>
            <a href="#"
               class="text-blue-500 hover:underline">Manage Products</a>
            <br>
            <a href="#"
               class="text-blue-500 hover:underline">Manage Categories</a>
        </div>
    </div>
@endsection
