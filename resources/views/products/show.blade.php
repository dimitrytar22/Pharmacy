@extends('layouts.main')

@section('title')
    {{$product->title}}
@endsection

@section('content')
    <div class="ml-2 mt-2">
        <a href="{{ route('categories.index') }}" class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-300">
            ← Back
        </a>
    </div>
    <button id="scrollToTopBtn" class="scroll-to-top">&#8679;</button>

    <section id="product-details" class="py-16 bg-gray-100">
        <div class="container mx-auto max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Product Image -->
            <div class="w-full bg-gray-200">
                <img src="{{$product->image == null ? "https://picsum.photos/600/400" : asset("images/" . $product->image) }}" alt="Product Image" class="w-full h-full object-cover">
            </div>

            <!-- Product Info -->
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800">{{$product->title}}</h1>
                <p class="mt-2 text-gray-600">Effective relief from pain, inflammation, and fever. Trusted for over 30 years in managing pain symptoms.</p>

                <div class="mt-6">
                    <h2 class="text-lg font-bold text-gray-800">Key Features:</h2>
                    <ul class="list-disc list-inside text-gray-700 mt-2">
                        @foreach($product->features as $feature)
                            <li><span class="font-semibold">{{$feature->title}}: </span>{{$feature->description}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-6">
                    <h2 class="text-lg font-bold text-gray-800">Instruction:</h2>
                    <p class="text-gray-700 mt-2">
                        {!! html_entity_decode($product->instruction) !!}
                         </p>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <span class="text-3xl font-bold text-blue-500">{{$product->price}} ₴</span>
                    <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">Buy Now</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Получаем кнопку
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');

        // Функция для показа/скрытия кнопки
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) { // Показываем кнопку при прокрутке более 300px
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        });

        // Функция для прокрутки наверх
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth' // Плавная прокрутка
            });
        });
    </script>
@endsection
