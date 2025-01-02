<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
<div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-800 text-white min-h-screen">
        <div class="p-4">
            <a href="">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Admin Logo" class="h-10">
                    <h1 class="text-xl font-bold ml-2">Admin Panel</h1>
                </div>
            </a>
        </div>
        <nav class="mt-8">
            <ul class="space-y-4 px-4">
                <li>
                    <a href="" class="block text-white hover:bg-blue-700 rounded px-3 py-2">Dashboard</a>
                </li>
                <li>
                    <a href="" class="block text-white hover:bg-blue-700 rounded px-3 py-2">Manage Products</a>
                </li>
                <li>
                    <a href="" class="block text-white hover:bg-blue-700 rounded px-3 py-2">Manage Categories</a>
                </li>
                <li>
                    <a href="" class="block text-white hover:bg-blue-700 rounded px-3 py-2">Orders</a>
                </li>
                <li>
                    <a href="" class="block text-white hover:bg-blue-700 rounded px-3 py-2">Users</a>
                </li>
                <li>
                    <a href="" class="block text-white hover:bg-blue-700 rounded px-3 py-2">Settings</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        <header class="bg-white shadow">
            <div class="container mx-auto flex items-center justify-between p-4">
                <h2 class="text-xl font-bold">Admin Panel</h2>
                <div>
                    @auth
                        <div class="flex items-center space-x-4">
                            <span>{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <main class="p-8">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
