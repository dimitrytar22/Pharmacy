document.addEventListener('DOMContentLoaded', function () {
    const cartModalElement = document.querySelector('.cart-modal');

    if (!cartModalElement) return;

    let cartModal = bootstrap.Modal.getInstance(cartModalElement);

    if (!cartModal) {
        cartModal = new bootstrap.Modal(cartModalElement);
    }
    const closeButtons = cartModalElement.querySelectorAll('.close-button');
    const payButton = cartModalElement.querySelector('.pay-button');



    cartModal._element.setAttribute('inert', '');

    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            cartModal.hide();
        });
    });




    cartModal._element.addEventListener('show.bs.modal', function () {
        cartModal._element.removeAttribute('inert');
    });
    cartModal._element.addEventListener('hide.bs.modal', function () {
        cartModal._element.setAttribute('inert', '');
    });

    payButton.addEventListener('click', async function (event){
        event.preventDefault();
        const form = event.target.closest('form');
        const url = form.action;
        const response = await fetch(url, {
           headers: {
               "Content-Type": "application/json",
           } ,
            method: "POST",
            body: JSON.stringify({
                _token: form.querySelector('input[name="_token"]').value,
                a: 1,
                b: 3
            }),
        });
        const json = await response.json();
        if(response.ok){
            console.log(json);
        }
    });


});
