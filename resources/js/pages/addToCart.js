document.addEventListener('DOMContentLoaded', function () {
    const cart = document.querySelector('.cart');
    const cartItemsCount = cart.parentElement.querySelector('.items-count');
    const cartModalElement = document.querySelector('.cart-modal');

    if (!cartModalElement) return;

    let cartModal = bootstrap.Modal.getInstance(cartModalElement);

    if (!cartModal) {
        cartModal = new bootstrap.Modal(cartModalElement);
    }
    const itemsBlock = cartModal._element.querySelector('.products-block');
    const addToCartButton = document.querySelectorAll('.add-to-cart');

    let items = JSON.parse(localStorage.getItem('products'));



    if (items) {
        cartItemsCount.removeAttribute('hidden');
        Object.keys(items).forEach((key) => {
            let data = {
                id: items[key].id,
                name: items[key].name,
                price: items[key].price,
                amount: items[key].amount,
                imageUrl: items[key].imageUrl
            };
            if (!data.id || !data.name) {
                localStorage.removeItem('products');
            } else {
                cartItemsCount.innerText = addItemToCart(data);
            }


        });
    }
    cart.addEventListener('click', function (event) {
        event.preventDefault();
        cartModal.show();
    });

    addToCartButton.forEach((btn) => {
        btn.addEventListener('click', function (event) {
            let product = event.target.closest('.product-card');
            let id = product.dataset.id;
            let name = product.querySelector('.product-title').innerText;
            let price = product.querySelector('.product-price').innerText;
            let amount = product.querySelector('.product-amount')?.value ?? 1;
            let imageUrl = product.querySelector('.product-image-url img').src;
            let data = {
                id,
                name,
                price,
                amount,
                imageUrl
            };
            cartItemsCount.removeAttribute('hidden');
            cartItemsCount.innerText = addItemToStorage(data) ?? 0;
            addItemToCart(data);
            cartModal.show();

        });
    });
    itemsBlock.addEventListener('click', function (event) {
        let elem = event.target;

        let card = elem.closest('.item-card');
        let id = card.dataset.id;
        let amount = card.querySelector('.product-amount');

        let amountChange = new Event('change');
        switch (elem.dataset.action) {
            case 'delete':
                deleteItemFromStorage(id);
                deleteItemFromCart(id);
                break;
            case 'decrease':
                if (amount.value <= 1)
                    return;
                amount.value--;
                amount.dispatchEvent(amountChange);


                break;
            case 'increase':
                amount.value++;
                amount.dispatchEvent(amountChange);



                break;
            default:
                break;
        }
    });


    function deleteItemFromCart(id) {
        let item = itemsBlock.querySelector(`.card[data-id="${id}"]`);
        item.remove();
        cartItemsCount.innerText = itemsBlock.children.length;
        if (itemsBlock.children.length <= 0) {
            cartItemsCount.setAttribute('hidden', '');
        }
    }

    function addItemToStorage(data) {
        let storedProducts = localStorage.getItem('products');
        if (!storedProducts) {
            localStorage.setItem('products', JSON.stringify([data]));
            storedProducts = JSON.parse(localStorage.getItem('products'));

        } else {
            storedProducts = JSON.parse(storedProducts);

            let existingItemId = itemExistsInStorage(data);

            if (!existingItemId)
                storedProducts.push(data);
            else {
                Object.keys(storedProducts).forEach((key) => {
                    if (storedProducts[key].id === existingItemId)
                        storedProducts[key].amount += data.amount;

                });
            }

            localStorage.setItem('products', JSON.stringify(storedProducts));
        }
        return storedProducts?.length ?? false;
    }

    function addItemToCart(data) {
        let existingItem = itemsBlock.querySelector(`.product[data-id="${data.id}"]`);
        if (existingItem) {
            existingItem.querySelector('.product-amount').value = Number(existingItem.querySelector('.product-amount').value) + Number(data.amount);
            return;
        }

        let item = document.createElement('div');
        item.className = 'card item-card rounded-3 mb-4 product';
        item.setAttribute('data-id', data.id);
        item.innerHTML = `<div class="card-body p-4">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-2">
                <img
                    src="${data.imageUrl}"
                    class="img-fluid rounded-3 product-imageUrl" alt="Product">
            </div>
            <div class="col-md-6">
                <p class="lead fw-normal mb-2 product-name">${data.name}</p>
            </div>
            <div class="col-md-3 d-flex">

                    <i class="fas fa-minus reduce-product" data-action="decrease"></i>

               <input  value="${data.amount}"
       type="text" inputmode="numeric" pattern="\d*"
       class="form-control form-control-sm product-amount"
       oninput="this.value = this.value.replace(/^0+/, '').replace(/[^0-9]/g, '')">





                    <i class="fas fa-plus increase-product" data-action="increase"></i>
            </div>
            <div class="col-md-2 text-end">
                <h5 class="mb-0 product-price">${data.price}</h5>
            </div>
            <div class="col-md-1 text-end">
                <a class="text-danger"><i data-action="delete"
                        class="fas fa-trash fa-lg"></i></a>
            </div>
        </div>
    </div>`;
        itemsBlock.append(item);
        return itemsBlock.children.length;
    }

    function deleteItemFromStorage(id) {
        let items = JSON.parse(localStorage.getItem('products'));
        if (!Array.isArray(items) && items)
            items = [items];
        for (const key of Object.keys(items)) {
            if (items[key].id === id) {
                items.splice(key, 1);
                if (items.length > 0)
                    localStorage.setItem('products', JSON.stringify(items));
                else
                    localStorage.removeItem('products');

                break;
            }
        }
    }

    function itemExistsInStorage(item) {
        let storedProducts = JSON.parse(localStorage.getItem('products'));
        if (!Array.isArray(storedProducts))
            storedProducts = [storedProducts];
        let itemExists = false;

        Object.keys(storedProducts).forEach((key) => {
            if (item.id === storedProducts[key].id) {
                itemExists = storedProducts[key].id;
            }
        });
        return itemExists;
    }



});
