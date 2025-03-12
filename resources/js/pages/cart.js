document.addEventListener('DOMContentLoaded', function () {
    const cart = document.querySelector('.cart');
    const cartItemsCount = cart.parentElement.querySelector('.items-count');
    const cartModal = new bootstrap.Modal(document.querySelector('.modal'));
    const itemsBlock = cartModal._element.querySelector('.items-block');
    const addToCartButton = document.querySelectorAll('.add-to-cart');
    let items = JSON.parse(localStorage.getItem('items'));
    if (!Array.isArray(items) && items)
        items = [items];


    cartModal._element.setAttribute('inert', '');

    cartItemsCount.innerText = items?.length;
    if (items) {
        cartItemsCount.removeAttribute('hidden');
        Object.keys(items).forEach((key) => {
            let data = {
                id: items[key].id,
                name: items[key].name,
                price: items[key].price,
                imageUrl: items[key].imageUrl
            };
            cartItemsCount.innerText = addItemToCart(data);


        });
    }

    addToCartButton.forEach((btn) => {
        btn.addEventListener('click', function (event) {
            let product = event.target.closest('.product-card');
            let id = product.dataset.id;
            let name = product.querySelector('.product-title').innerText;
            let price = product.querySelector('.product-price').innerText;
            let imageUrl = product.querySelector('.product-image-url img').src;
            let data = {
                id,
                name,
                price,
                imageUrl
            };
            cartItemsCount.removeAttribute('hidden');
            cartItemsCount.innerText = addItemToStorage(data) ?? 0;
            addItemToCart(data);

        });
    });
    itemsBlock.addEventListener('click', function (event) {
        let elem = event.target;

        switch (elem.dataset.action) {
            case 'delete':
                let card = elem.closest('.item-card');
                let id = card.dataset.id;
                deleteItemFromStorage(id);
                deleteItemFromCart(id);
                break;
            default:
                break;
        }
    });


    cart.addEventListener('click', function (event) {
        event.preventDefault();
        cartModal.show();
    });
    cartModal._element.addEventListener('show.bs.modal', function () {
        cartModal._element.removeAttribute('inert');
    });
    cartModal._element.addEventListener('hide.bs.modal', function () {
        cartModal._element.setAttribute('inert', '');
    });

    function deleteItemFromCart(id) {
        let item = itemsBlock.querySelector(`.card[data-id="${id}"]`);
        item.remove();
        cartItemsCount.innerText = itemsBlock.children.length;
        if(itemsBlock.children.length <= 0){
            cartItemsCount.setAttribute('hidden','');
        }
    }

    function addItemToStorage(data) {
        let storedItems;
        if (!localStorage.getItem('items')) {
            localStorage.setItem('items', JSON.stringify(data));
            storedItems = JSON.parse(localStorage.getItem('items'));
            if(!Array.isArray(storedItems))
                storedItems = [storedItems];
        } else {
            storedItems = JSON.parse(localStorage.getItem('items'));
            if (Array.isArray(storedItems)) {
                storedItems.push(data);
            } else {
                storedItems = [storedItems];
                storedItems.push(data);
            }
            localStorage.setItem('items', JSON.stringify(storedItems));
        }
        return storedItems.length ?? false;
    }

    function addItemToCart(data) {
        let item = document.createElement('div');
        item.className = 'card item-card rounded-3 mb-4';
        item.setAttribute('data-id', data.id);
        item.innerHTML = `<div class="card-body p-4">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-2">
                <img
                    src="${data.imageUrl}"
                    class="img-fluid rounded-3" alt="Product">
            </div>
            <div class="col-md-6">
                <p class="lead fw-normal mb-2">${data.name}</p>
            </div>
            <div class="col-md-3 d-flex">
                <button class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                    <i class="fas fa-minus"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="2"
                       type="number" class="form-control form-control-sm"/>

                <button class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="col-md-2 text-end">
                <h5 class="mb-0">${data.price}</h5>
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
        let items = JSON.parse(localStorage.getItem('items'));
        if (!Array.isArray(items) && items)
            items = [items];
        for (const key of Object.keys(items)) {
            if (items[key].id === id) {
                items.splice(key, 1);
                if (items.length > 0)
                    localStorage.setItem('items', JSON.stringify(items));
                else
                    localStorage.removeItem('items');

                break;
            }
        }
    }
});
