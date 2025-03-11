<div class="modal fade cart-modal" id="exampleModalLong" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true" inert>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Shopping Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="h-100">
                    <div class="container h-100 py-5">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-10 items">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="fw-normal mb-0">Shopping Cart</h3>
                                    <div>
                                        <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">Price <i class="fas fa-angle-down mt-1"></i></a></p>
                                    </div>
                                </div>

                                @foreach([1,2,3,4] as $item)
                                    <div class="card rounded-3 mb-4">
                                        <div class="card-body p-4">
                                            <div class="row d-flex justify-content-between align-items-center">
                                                <div class="col-md-2">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp" class="img-fluid rounded-3" alt="Product">
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="lead fw-normal mb-2">Product Name</p>
                                                    <p><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
                                                </div>
                                                <div class="col-md-3 d-flex">
                                                    <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                        <i class="fas fa-minus"></i>
                                                    </button>

                                                    <input id="form1" min="0" name="quantity" value="2" type="number" class="form-control form-control-sm" />

                                                    <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <h5 class="mb-0">$499.00</h5>
                                                </div>
                                                <div class="col-md-1 text-end">
                                                    <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="card rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-8">
                                                <input type="text" class="form-control form-control-lg" placeholder="Discount code">
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <button class="btn btn-outline-warning btn-lg">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <button class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
