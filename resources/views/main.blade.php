@extends('layouts.main')

@section('title')
    Your Health Partner
@endsection

@section('content')

    <section id="hero" class="bg-primary text-white py-5">
        <div class="container text-center">
            <h2 class="display-4 font-weight-bold">Your Trusted Partner in Health</h2>
            <p class="mt-4 lead">Explore a wide range of medicines, healthcare products, and expert services all in one place.</p>
            <a href="{{route("categories.index")}}" class="btn btn-light btn-lg mt-4">Shop Now</a>
        </div>
    </section>

    <section id="products" class="py-5">
        <div class="container text-center">
            <h2 class="h3 font-weight-bold">Our Products</h2>
            <div class="row mt-4">
                @foreach($categories as $category)
                    <div class="col-md-3 mb-4">
                        <a href="{{route('categories.show', $category->id)}}">
                            <div class="card shadow">
                                <img src="{{$category->image == null  ? "https://dummyimage.com/300x300/cccccc/000000&text=$category->title" : asset('images/'.$category->image)}}"
                                     class="card-img-top" alt="{{$category->title}}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{$category->title}}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="services" class="bg-light py-5">
        <div class="container text-center">
            <h2 class="h3 font-weight-bold">Our Services</h2>
            <ul class="list-unstyled mt-4">
                <li class="lead">Prescription Fulfillment</li>
                <li class="lead">Health Consultations</li>
                <li class="lead">Vaccination Services</li>
                <li class="lead">Online Ordering & Delivery</li>
            </ul>
        </div>
    </section>

    <section id="about" class="py-5">
        <div class="container text-center">
            <h2 class="h3 font-weight-bold">About Us</h2>
            <p class="mt-4 lead">At Pharmacy, we are dedicated to providing exceptional healthcare services and products. With years of experience, we strive to support our community's health and well-being.</p>
        </div>
    </section>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 Pharmacy. All Rights Reserved.</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#" class="text-white hover:text-primary">Facebook</a></li>
                <li class="list-inline-item"><a href="#" class="text-white hover:text-primary">Twitter</a></li>
                <li class="list-inline-item"><a href="#" class="text-white hover:text-primary">Instagram</a></li>
            </ul>
        </div>
    </footer>

@endsection
