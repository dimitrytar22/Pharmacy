<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light text-dark">
<div class="d-flex">
    <aside class="bg-primary text-white vh-100 p-3" style="width: 250px;">
        <div class="mb-4 text-center">
            <a href="{{ route('admin.index') }}" class="text-white text-decoration-none d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Admin Logo" class="me-2" style="height: 40px;">
                <h1 class="h5 mb-0">Admin Panel</h1>
            </a>
        </div>
        <nav>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link text-white">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link text-white">Manage Products</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link text-white">Manage Categories</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Orders</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Users</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Settings</a>
                </li>
                <li class="nav-item mt-3">
                    <a href="{{ route('main') }}" class="btn btn-danger w-100">Exit Admin Panel</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <header class="bg-white shadow p-3 mb-4">
            <div class="container d-flex justify-content-between align-items-center">
                <h2 class="h4">Admin Panel @hasSection('subtitle') - @yield('subtitle') @endif</h2>
                <div>
                    @auth
                        <div class="d-flex align-items-center">
                            <span class="me-3">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Log Out</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <main class="container py-3">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
