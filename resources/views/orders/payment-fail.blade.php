@extends('layouts.main')

@section('title')
    Order Failed
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-danger">
                    <div class="card-header bg-danger text-white">
                        <h2 class="h5 mb-0">
                            <i class="fas fa-times-circle me-2"></i>
                            Payment for order #{{ $order->id }} failed
                        </h2>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-danger d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                            <div>
                                <h3 class="h6 mb-1">Payment Error</h3>

                            </div>
                        </div>

                        <div class="d-grid gap-3 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('orders.checkout', $order->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Order
                            </a>
{{--                            <a href="{{ route('checkout.retry', $order->id) }}" class="btn btn-danger">--}}
{{--                                <i class="fas fa-sync-alt me-2"></i>Retry Payment--}}
{{--                            </a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
