@extends('layouts.main')

@section('title')
    {{$product->title}}
@endsection

@vite('resources/js/pages/product.js')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary mb-3">
            &larr; Back
        </a>
        <button id="scrollToTopBtn" class="btn btn-primary scroll-to-top">&#8679;</button>

        <section id="product-details" class="py-5 bg-light rounded-3 shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-lg border-0">
                            <img src="{{$product->image == null ? 'https://picsum.photos/600/400' : asset('images/' . $product->image) }}" class="card-img-top rounded" alt="Product Image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h1 class="card-title text-primary">{{$product->title}}</h1>
                            <p class="card-text text-muted">Effective relief from pain, inflammation, and fever. Trusted for over 30 years in managing pain symptoms.</p>
                            <h2 class="h5 mt-4">Key Features:</h2>
                            <ul class="list-group list-group-flush">
                                @foreach($product->features as $feature)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>{{$feature->title}}:</strong> {{$feature->description}}
                                    </li>
                                @endforeach
                            </ul>

                            <h2 class="h5 mt-3">Instruction:</h2>
                            <p>{!! html_entity_decode($product->instruction) !!}</p>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <span class="h3 text-primary">{{$product->price}} ₴</span>
                                <button class="btn btn-lg btn-primary buy-button mt-2 add-to-cart">
                                    Add to cart
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




    </div>

    <script>
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        window.addEventListener('scroll', () => {
            scrollToTopBtn.style.display = window.scrollY > 300 ? 'block' : 'none';
        });
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
@endsection
