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
        <a href="{{route('main')}}">
            <div class="flex items-center">
                <img src="{{asset('images/logo.png')}}" alt="Pharmacy Logo" class="h-10">
                <h1 class="text-xl font-bold ml-2">Pharmacy</h1>
            </div>
        </a>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="{{route('main')}}" class="text-gray-700 hover:text-blue-500">Home</a></li>
                <li><a href="{{route('products.index')}}" class="text-gray-700 hover:text-blue-500">Products</a></li>
                <li><a href="#services" class="text-gray-700 hover:text-blue-500">Services</a></li>
                <li><a href="#about" class="text-gray-700 hover:text-blue-500">About Us</a></li>
                <li><a href="{{route('contact.create')}}" class="text-gray-700 hover:text-blue-500">Contact</a></li>
            </ul>

        </nav>
        <div>
            @guest()
                <a href="{{route('login')}}"
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</a>
                <a href="{{route('register')}}"
                   class="ml-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Sign
                    Up</a>
            @endguest
            @auth()
                <div class="hidden sm:flex ">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-end border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>
</div>

</body>
</html>
