@extends('layouts.app')

@section('title')
    Pharmacy - Your Health Partner
@endsection

@section('content')


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
                <a href="login.html" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</a>
                <a href="register.html" class="ml-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Sign
                    Up</a>
            </div>
        </div>
    </header>

    <section id="hero" class="bg-blue-500 text-white py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold">Your Trusted Partner in Health</h2>
            <p class="mt-4 text-lg">Explore a wide range of medicines, healthcare products, and expert services all in
                one
                place.</p>
            <a href="#products"
               class="mt-6 inline-block bg-white text-blue-500 font-bold px-6 py-3 rounded hover:bg-gray-100">Shop
                Now</a>
        </div>
    </section>

    <section id="products" class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold">Our Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
                <div class="bg-white shadow rounded p-4">
                    <img src="medicine1.jpg" alt="Medicine 1" class="h-40 w-full object-cover rounded">
                    <h3 class="mt-4 font-semibold">Pain Relievers</h3>
                </div>
                <div class="bg-white shadow rounded p-4">
                    <img src="medicine2.jpg" alt="Medicine 2" class="h-40 w-full object-cover rounded">
                    <h3 class="mt-4 font-semibold">Vitamins & Supplements</h3>
                </div>
                <div class="bg-white shadow rounded p-4">
                    <img src="medicine3.jpg" alt="Medicine 3" class="h-40 w-full object-cover rounded">
                    <h3 class="mt-4 font-semibold">Skin Care</h3>
                </div>
                <div class="bg-white shadow rounded p-4">
                    <img src="medicine4.jpg" alt="Medicine 4" class="h-40 w-full object-cover rounded">
                    <h3 class="mt-4 font-semibold">Personal Hygiene</h3>
                </div>
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

    <section id="contact" class="bg-gray-100 py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center">Contact Us</h2>
            <form action="submit_form.php" method="POST" class="mt-8 max-w-xl mx-auto bg-white shadow rounded p-6">
                <label for="name" class="block text-sm font-semibold">Name</label>
                <input type="text" id="name" name="name" required class="w-full mt-2 p-2 border rounded">

                <label for="email" class="block text-sm font-semibold mt-4">Email</label>
                <input type="email" id="email" name="email" required class="w-full mt-2 p-2 border rounded">

                <label for="message" class="block text-sm font-semibold mt-4">Message</label>
                <textarea id="message" name="message" rows="4" required
                          class="w-full mt-2 p-2 border rounded"></textarea>

                <button type="submit" class="mt-6 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Send
                    Message
                </button>
            </form>
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
