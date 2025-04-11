<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel</title>

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light text-dark">
<div class="container-fluid">
    <div class="row min-vh-100">
        <aside class="col-12 col-md-2 col-xl-2 bg-primary text-white d-flex flex-column p-3">
            <div class="mb-4 text-center">
                <a href="{{ route('admin.index') }}" class="text-white text-decoration-none d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="Admin Logo" class="me-2" style="height: 40px;">
                    <h1 class="h5 mb-0">Admin Panel</h1>
                </a>
            </div>
            <nav class="flex-grow-1">
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
                        <a href="{{route('admin.orders.index')}}" class="nav-link text-white">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">Settings</a>
                    </li>
                </ul>
            </nav>
            <div class="mt-auto">
                <a href="{{ route('main') }}" class="btn btn-danger w-100">Exit Admin Panel</a>
            </div>
        </aside>

        <div class="col bg-white d-flex flex-column p-0">
            <header class="shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Admin Panel @hasSection('subtitle') - @yield('subtitle') @endif</h2>
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
            </header>

            <main class="p-4 flex-grow-1">
                @yield('content')
            </main>
        </div>
    </div>
</div>

</body>
</html>
