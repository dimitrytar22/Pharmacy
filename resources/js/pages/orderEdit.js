document.addEventListener('DOMContentLoaded', function () {
    const confirmDeleteButton = document.querySelector('.confirm-delete-button');
    const searchField = document.querySelector('#product-search-prompt-field');
    const searchStatus = document.querySelector('#search-status');

    searchField.addEventListener('input', function (event) {
        const enteredPrompt = event.target.value;
        if (enteredPrompt.length < 3)
            return;

        searchProduct(enteredPrompt);
    });

    confirmDeleteButton.addEventListener('click', function () {
        confirmDelete();
    });

    document.getElementById('edit-order-form').addEventListener('submit', function (e) {
        const paymentSelect = document.getElementById('payment_method_id');
        const discountSelect = document.getElementById('discount_id');

        if (!paymentSelect.value) {
            paymentSelect.removeAttribute('name');
        }

        if (!discountSelect.value) {
            discountSelect.removeAttribute('name');
        }
    });

    function confirmDelete() {
        if (confirm('Are you sure you want to delete this order?')) {
            document.getElementById('delete-form').submit();
        }
    }

    function addProduct(data) {
        const newProductsBlock = document.querySelector('.new-products');
        const productBlock = document.createElement('div');
        productBlock.className = "list-group-item d-flex justify-content-between align-items-center border mb-2";
        productBlock.innerHTML = `<span>${data.title}</span>
                                    <span class="badge bg-secondary">Amount: ${data.amount}</span>
                                    <input type="hidden" name="product_ids[]" value="${data.id}">`;
        newProductsBlock.appendChild(productBlock);
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
            console.log(json);
            if (json.status) {
                addProduct({
                    title:213,
                    amount:123213,
                    id:1
                })
            }else{

            }
        } else {
            console.error(response.status);
            searchStatus.innerHTML = 'No results found.';
        }
    }
});
