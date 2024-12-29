<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
<header class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between p-4">
        <div class="flex items-center">
            <img src="{{asset('images/logo.png')}}" alt="Pharmacy Logo" class="h-10">
            <h1 class="text-xl font-bold ml-2">Pharmacy</h1>
        </div>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="#home" class="text-gray-700 hover:text-blue-500">Home</a></li>
                <li><a href="#products" class="text-gray-700 hover:text-blue-500">Products</a></li>
                <li><a href="#services" class="text-gray-700 hover:text-blue-500">Services</a></li>
                <li><a href="#about" class="text-gray-700 hover:text-blue-500">About Us</a></li>
                <li><a href="#contact" class="text-gray-700 hover:text-blue-500">Contact</a></li>
            </ul>
        </nav>
        <div>
            <a href="{{route('login')}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</a>
            <a href="{{route('register')}}" class="ml-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Sign
                Up</a>
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>
</div>

</body>
</html>
