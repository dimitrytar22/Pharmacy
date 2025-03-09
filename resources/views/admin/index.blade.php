@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <div class="container mt-4">
        <h1 class="h2 mb-4">Welcome to the Admin Panel, {{ Auth::user()->name }}!</h1>

        <!-- Intro Text -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="lead">Here you can manage your store’s content, monitor user activity, and ensure smooth operation of the platform.
                    If you encounter any issues, please reach out to the technical team.</p>
            </div>
        </div>

        <!-- Overview Section -->
        <div class="row mb-4">
            <!-- Total Products -->
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ asset('images/products.png') }}" alt="Products Icon" class="me-3" width="40">
                        <div>
                            <h5 class="card-title">Total Products</h5>
                            <p class="h3">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ asset('images/categories.png') }}" alt="Categories Icon" class="me-3" width="40">
                        <div>
                            <h5 class="card-title">Total Categories</h5>
                            <p class="h3">{{ $totalCategories }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ asset('images/orders.png') }}" alt="Orders Icon" class="me-3" width="40">
                        <div>
                            <h5 class="card-title">Total Orders</h5>
                            <p class="h3">1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Updates -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Recent Updates</h5>
                <p class="text-muted">Stay informed about the latest changes on the platform.</p>
                <ul class="list-group list-group-flush">
                    {{-- @foreach($recentUpdates as $update) --}}
                    {{-- <li class="list-group-item">{{ $update }}</li> --}}
                    {{-- @endforeach --}}
                </ul>
            </div>
        </div>

        <!-- Important Links -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Quick Access</h5>
                <p class="text-muted">Access key features quickly:</p>
                <a href="#" class="btn btn-link">Manage Products</a>
                <a href="#" class="btn btn-link">Manage Categories</a>
            </div>
        </div>
    </div>
@endsection
