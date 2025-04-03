@extends('layouts.main')

@section('title')
    Order checkout
@endsection

@section('content')
    <div class="container">
        <h1>Детали заказа #{{ $order->id }}</h1>

        <!-- Информация о пользователе -->
        <div class="card mb-3">
            <div class="card-header">Пользователь</div>
            <div class="card-body">
                @if($order->user)
                    <p><strong>ID:</strong> {{ $order->user->id }}</p>
                    <p><strong>Имя:</strong> {{ $order->user->name }}</p>
                @else
                    <p class="text-muted">Пользователь не указан</p>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Товары в заказе</div>
            <div class="card-body">
                @if($order->products)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Цена</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ Str::limit($product->description, 50) }}</td>
                                    <td>{{ number_format($product->price, 2) }} ₽</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">Нет товаров в заказе</div>
                @endif
            </div>
        </div>

        <!-- Информация о скидке -->
        <div class="card mb-3">
            <div class="card-header">Скидка</div>
            <div class="card-body">
                @if($order->discount)
                    <p><strong>ID:</strong> {{ $order->discount->id }}</p>
                    <p><strong>Название:</strong> {{ $order->discount->title }}</p>
                @else
                    <p class="text-muted">Скидка не применена</p>
                @endif
            </div>
        </div>

        <!-- Дополнительные поля заказа (пример) -->
        <div class="card">
            <div class="card-header">Детали заказа</div>
            <div class="card-body">
                <p><strong>Дата создания:</strong> {{ $order->created_at }}</p>
                <!-- Добавьте другие поля заказа по необходимости -->
            </div>
        </div>
    </div>
@endsection
