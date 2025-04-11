document.addEventListener('DOMContentLoaded', function () {
    const confirmDeleteButton = document.querySelector('.confirm-delete-button');
    const searchField = document.querySelector('#product-search-prompt-field');
    const searchStatus = document.querySelector('#search-status');
    const existingProducts = document.querySelectorAll('.product');


    existingProducts.forEach((item) => {
        const existingAmounts = item.querySelector('.product-amount');
        const existingRemoveButton = item.querySelector('.remove-product-button');
        addRemoveListener(existingRemoveButton);
    });


    searchField.addEventListener('input', function (event) {
        const enteredPrompt = event.target.value;

        if (enteredPrompt.length < 3) {
            removeAllProducts();
            return;
        }

        searchProduct(enteredPrompt);
    });

    confirmDeleteButton.addEventListener('click', function () {
        confirmDelete();
    });

    document.getElementById('edit-order-form').addEventListener('submit', function (e) {
        const paymentSelect = document.getElementById('payment_method_id');
        const discountSelect = document.getElementById('discount_id');
        const finishedAtInput = document.getElementById('finished_at');

        if (!paymentSelect.value) {
            paymentSelect.removeAttribute('name');
        }

        if (!discountSelect.value) {
            discountSelect.removeAttribute('name');
        }

        if(!finishedAtInput.value){
            finishedAtInput.removeAttribute('name');
        }
    });


    function addButtonListener(event) {
        const elem = event.target;
        const available = elem.parentElement.querySelector('.product-available').dataset.value;
        const productAmount = elem.parentElement.querySelector('.product-amount').value;
        const productCount = elem.parentElement.querySelector('.product-amount').getAttribute('max');
        const title = elem.parentElement.parentElement.querySelector('.product-title').innerText;
        if (+productCount > +available) {
            return;
        }
        addProduct({
            id: elem.dataset.productId,
            title: title,
            amount: productAmount,
            count: productCount
        });
    }


    function confirmDelete() {
        if (confirm('Are you sure you want to delete this order?')) {
            document.getElementById('delete-form').submit();
        }
    }


    function addRemoveListener(item) {
        item.addEventListener('click', function () {
            item.closest('.product').remove();
        });
    }

    function addProduct(data) {
        const orderProducts = document.querySelector('.order-products');
        const productBlock = document.createElement('div');
        productBlock.className = 'list-group-item d-flex justify-content-between align-items-center border mb-2 product';
        productBlock.setAttribute('data-id', data.id);
        productBlock.innerHTML = `<span><strong>${data.title}</strong></span>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="number" class="form-control form-control-sm product-amount" name="products[${data.id}][amount]" value="${data.amount}" min="1" max="${data.count}" style="width: 80px;">
                                            <span
                                                class="badge bg-secondary">Available: ${data.count}</span>
                                            <span class="text-danger remove-product-button" data-id="${data.id}" style="cursor: pointer;">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        </div>
                                        <input type="hidden" name="products[${data.id}][id]" value="${data.id}">`;
        if (foundProductExists(data.id)) {
            console.log(foundProductExists(data.id))
            const existingProduct = orderProducts.querySelector(`.product[data-id="${data.id}"]`);
            updateProductAmount(existingProduct, data.amount);
            console.log(existingProduct);
        } else {
            orderProducts.appendChild(productBlock);
            addRemoveListener(productBlock.querySelector('.remove-product-button'));
        }

    }

    function updateProductAmount(product, amount) {
        const input = product.querySelector('.product-amount');
        input.value = +product.querySelector('.product-amount').value + +amount;
        return input.value;
    }

    function foundProductExists(id) {
        const productsBlock = document.querySelector('.order-products');
        let products = productsBlock.querySelectorAll('.product');
        let productExists = false;
        products.forEach((item) => {
            if ((+item.dataset.id) === (+id)) {
                productExists = true;
            }
        });
        return productExists;
    }

    function showFoundProducts(data) {
        if (!Array.isArray(data))
            data = [data];
        const newProductsBlock = document.querySelector('.products-search-list');
        newProductsBlock.innerHTML = '';
        data.forEach(function (product) {
            const productBlock = document.createElement('div');
            productBlock.className = "product list-group-item d-flex justify-content-between align-items-center border mb-3";
            productBlock.innerHTML = `<div style="flex: 1;">
                                        <span class="fw-bold product-title">${product.title}</span>
                                        <div class="text-muted" style="font-size: 0.875rem;">${product.category.title}</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="number" class="product-amount form-control form-control-sm w-25 me-2" value="1" min="1" max="${product.count}">
                                        <span class="product-available badge bg-secondary me-3" data-value="${product.count}">Available: ${product.count}</span>
                                        <button type="button" class="btn btn-sm btn-primary add-product-button" data-product-id="${product.id}">Add</button>
                                    </div>`;
            newProductsBlock.prepend(productBlock);
            productBlock.querySelector('.add-product-button').addEventListener('click', addButtonListener);

        });


    }

    function removeAllProducts() {
        const newProductsBlock = document.querySelector('.products-search-list');
        newProductsBlock.innerHTML = '';
    }

    async function searchProduct(prompt) {
        searchStatus.innerHTML = 'Searching...';
        const searchForm = document.querySelector('#search-form');
        const csrf = searchForm.querySelector('input[name="_token"]').value;
        const response = await fetch(searchForm.action, {
            headers: {
                "Content-Type": "application/json",
                'Accept': "application/json"
            },
            method: "POST",
            body: JSON.stringify({
                prompt,
                '_token': csrf
            })
        });

        const json = await response.json();
        searchStatus.innerHTML = '';
        if (response.ok) {
            if (json.status) {
                showFoundProducts(json.items)
            } else {
                removeAllProducts();
            }
        } else {
            console.error(response.status);
            searchStatus.innerHTML = 'No results found.';
        }
    }
});
