document.addEventListener('DOMContentLoaded', function () {
    const cartModalElement = document.querySelector('.cart-modal');
    const discountApplyButton = cartModalElement.querySelector('.discount-apply-button');
    const closeButtons = cartModalElement.querySelectorAll('.close-button');
    const payButton = cartModalElement.querySelector('.pay-button');
    const resetDiscountButton = cartModalElement.querySelector('.reset-discount-button');
    const productAmount = cartModalElement.querySelectorAll('.product-amount');


    if (!cartModalElement) return;

    let cartModal = bootstrap.Modal.getInstance(cartModalElement);

    if (!cartModal) {
        cartModal = new bootstrap.Modal(cartModalElement);
    }

    applyDiscount();
    cartModal._element.setAttribute('inert', '');

    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            cartModal.hide();
        });
    });

    productAmount.forEach((item) => {
        item.addEventListener('change', function (event) {
            let inputField = event.target;
            let value = inputField.value;
            if (!Number(value))
                return;
            console.log(inputField);
            let id = item.closest('.product').dataset.id;
            let name = item.closest('.product').querySelector('.product-name').innerText;
            let price = item.closest('.product').querySelector('.product-price').innerText;
            let amount = item.closest('.product').querySelector('.product-amount').value;
            let imageUrl = item.closest('.product').querySelector('.product-imageUrl').src;
            let product = {
                id,
                name,
                price,
                amount,
                imageUrl
            };
            updateProductInStorage(product);
        });
    });

    function updateProductInStorage(product) {
        let data = JSON.parse(localStorage.getItem('products'));
        if (!Array.isArray(data))
            data = [data];

        Object.keys(data).forEach((key) => {
            if (data[key].id === product.id) {
                data[key] = product;
            }
        });
        localStorage.setItem('products', JSON.stringify(data));
    }

    cartModal._element.addEventListener('show.bs.modal', function () {
        cartModal._element.removeAttribute('inert');
    });
    cartModal._element.addEventListener('hide.bs.modal', function () {
        cartModal._element.setAttribute('inert', '');
    });
    cartModal._element.addEventListener('hidden.bs.modal', function () {
        const errorBlock = this.querySelector('.error-message');
        errorBlock.setAttribute('hidden', '');
    });

    payButton.addEventListener('click', function (event) {
        const form = cartModalElement.querySelector('.payment-form');

        let products = JSON.parse(localStorage.getItem('products')) ?? [];
        let discount = JSON.parse(localStorage.getItem('discount')) ?? null;
        let discountInput = document.createElement('input');
        if (discount) {
            discountInput.type = 'hidden';
            discountInput.name = `discount_id`;
            discountInput.value = discount.id;
            form.appendChild(discountInput);
        }
        let paymentMethodInput = document.createElement('input');
        paymentMethodInput.type = 'hidden';
        paymentMethodInput.name = `payment_method`;
        paymentMethodInput.value = 'paypal';
        form.appendChild(paymentMethodInput);


        products.forEach((product, index) => {
            let idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = `products[${index}][id]`;
            idInput.value = product.id;
            form.appendChild(idInput);

            let amountInput = document.createElement('input');
            amountInput.type = 'hidden';
            amountInput.name = `products[${index}][amount]`;
            amountInput.value = product.amount;
            form.appendChild(amountInput);
        });

        form.submit();
    });


    discountApplyButton.addEventListener('click', async function (event) {
        const form = cartModalElement.querySelector('.discount-apply-form');
        const discountTitle = form.querySelector('.discount-title').value;
        const errorBlock = form.querySelector('.error-message');
        if (!discountTitle)
            return;
        const url = form.action;

        const response = await fetch(url, {
            headers: {
                "Content-Type": "application/json",
            },
            method: "POST",
            body: JSON.stringify({
                _token: form.querySelector('input[name="_token"]').value,
                'discount': discountTitle,
            }),
        });
        const json = await response.json();
        if (response.ok) {
            console.log(json);
            if (json.status) {
                errorBlock.setAttribute('hidden', '');
                localStorage.setItem('discount', JSON.stringify({
                    id: json.data.discount.id,
                    title: json.data.discount.title,
                    size: json.data.discount.size
                }));
                applyDiscount();

            } else {
                errorBlock.innerText = json.error.message;
                errorBlock.removeAttribute('hidden');
            }
        } else {
            errorBlock.innerText = "Error";
            errorBlock.removeAttribute('hidden');
        }


    });

    function applyDiscount() {
        if (!discountSet()) {
            console.log('122312132');
            return;
        }
        let discount = JSON.parse(localStorage.getItem('discount'));
        let size = discount.size;
        discountApplyButton.classList.add('applied');
        let percentageBlock = cartModalElement.querySelector('.discount-percentage');
        let discountTitle = cartModalElement.querySelector('.discount-title');
        let percentageText = percentageBlock.querySelector('.text');
        percentageText.innerText = `-${size}%`;
        percentageBlock.removeAttribute('hidden');
        resetDiscountButton.removeAttribute('hidden');
        discountTitle.value = discount.title;
        discountTitle.readOnly = true;
    }

    function resetDiscount() {
        localStorage.removeItem('discount');
        discountApplyButton.classList.remove('applied');
        let percentageBlock = cartModalElement.querySelector('.discount-percentage');
        let percentageText = percentageBlock.querySelector('.text');
        let discountTitle = cartModalElement.querySelector('.discount-title');


        percentageText.innerText = ``;
        percentageBlock.setAttribute('hidden', '');
        resetDiscountButton.setAttribute('hidden', '');
        discountTitle.value = "";
        discountTitle.readOnly = false;

    }

    function cartEmpty() {
        return !Boolean(cartModalElement.querySelectorAll('.product').length);
    }

    function discountSet() {
        return Boolean(localStorage.getItem('discount'));
    }

    resetDiscountButton.addEventListener('click', function () {
        resetDiscount();
    });

});
