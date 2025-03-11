<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Pharmacy</title>



    @vite(['resources/js/app.js', 'resources/js/pages/cart.js'])
</head>
<body class="bg-light text-dark">

<header class="bg-white shadow py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('main') }}" class="d-flex align-items-center text-decoration-none text-dark">
            <img src="{{ asset('images/logo.png') }}" alt="Pharmacy Logo" class="me-2" style="height: 40px;">
            <h1 class="h4 fw-bold mb-0">Pharmacy</h1>
        </a>

        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="{{ route('main') }}" class="nav-link text-dark">Home</a></li>
                <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link text-dark">Products</a></li>
                <li class="nav-item"><a href="#services" class="nav-link text-dark">Services</a></li>
                <li class="nav-item"><a href="#about" class="nav-link text-dark">About Us</a></li>
                <li class="nav-item"><a href="{{ route('contact.create') }}" class="nav-link text-dark">Contact</a></li>
                <li class="nav-item">
                    <a class="nav-link text-dark position-relative">
                        <i class="fa-solid fa-cart-shopping cart" style="font-size: 18px; color: #007bff; margin-top: 5px;"></i>
                        <span class="badge bg-danger position-absolute top-25 start-100 translate-middle rounded-circle items-count" style="font-size: 12px; padding: 2px 6px;" hidden></span>
                    </a>
                </li>
            </ul>
        </nav>



        <div>
            @guest()
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success ms-2">Sign Up</a>
            @endguest

            @auth()
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        @can('view', \Illuminate\Support\Facades\Auth::user())
                            <li><a class="dropdown-item" href="{{ route('admin.index') }}">Admin Panel</a></li>
                        @endcan
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</header>

<main class="container my-4">
    @yield('content')
    <x-cart-modal></x-cart-modal>

</main>



</body>
</html>
