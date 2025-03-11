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
            addItemToCart(data);
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
            updateCart(data);
        });
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

    function updateCart(data){
        let items = addItemToStorage(data);
        addItemToCart(data);
        if(items){
            cartItemsCount.innerText = items;
        }
    }
    function addItemToStorage(data){
        let storedItems;
        if (!localStorage.getItem('items')) {
            localStorage.setItem('items', JSON.stringify(data));
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
                <a href="#!" class="text-danger"><i
                        class="fas fa-trash fa-lg"></i></a>
            </div>
        </div>
    </div>`;
        itemsBlock.append(item);
    }
});
