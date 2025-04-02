<div class="modal fade cart-modal" id="exampleModalLong" tabindex="-1" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true" inert>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Shopping Cart</h5>
                <button type="button" class="btn-close close-button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="h-100">
                    <div class="container h-100 py-5">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-10 products">

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="fw-normal mb-0">Shopping Cart</h3>
                                    <div>
                                        <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                                                                                                    class="text-body">Price
                                                <i class="fas fa-angle-down mt-1"></i></a></p>
                                    </div>
                                </div>
                                <form action="{{route('orders.checkout')}}" method="POST" class="payment-form">
                                    @csrf
                                    <div class="products-block">
                                    </div>
                                </form>

                                <div class="card rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <form action="{{asset(route('discounts.check'))}}" class="discount-apply-form">
                                            @csrf
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <input type="text"
                                                           class="form-control form-control-lg discount-title"
                                                           placeholder="Discount code">
                                                </div>

                                                <div
                                                    class="col-md-2 text-center discount-percentage d-flex align-items-center"
                                                    hidden>
                                                    <span class="badge bg-success p-2 w-100 text"></span>
                                                    <button type="button" class="btn-close ms-2 reset-discount-button"
                                                            aria-label="Close" data-bs-toggle="tooltip"
                                                            title="Reset discount" hidden></button>
                                                </div>

                                                <div class="col-md-4 text-end">
                                                    <button class="discount-apply-button" type="button">Apply</button>
                                                </div>

                                                <div class="alert alert-danger m-2 error-message" role="alert"
                                                     hidden></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block btn-lg close-button">Close</button>

                <button type="button" class="btn btn-warning btn-block btn-lg pay-button">Proceed to Pay</button>

            </div>
        </div>
    </div>
</div>
@vite('resources/js/pages/cart.js')
