@extends('layouts.main')

@section('title', 'Order Successful')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-success">
                    <div class="card-header bg-success text-white">
                        <h2 class="h5 mb-0">
                            <i class="fas fa-check-circle me-2"></i>
                            Order #{{ $order->id }} Successful!
                        </h2>
                    </div>

                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success mb-3" style="font-size: 3rem;"></i>
                            <h3 class="h4">Thank you for your purchase!</h3>
                            <p class="text-muted">Your payment has been processed successfully.</p>
                        </div>

                        <div class="alert alert-success">
                            <i class="fas fa-info-circle me-2"></i>
                            Order details have been sent to your email.
                        </div>

                        <div class="d-grid gap-3 d-md-flex justify-content-center mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                <i class="fas fa-home me-2"></i>Back to Home
                            </a>
{{--                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-success">--}}
{{--                                <i class="fas fa-receipt me-2"></i>View Order Details--}}
{{--                            </a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
