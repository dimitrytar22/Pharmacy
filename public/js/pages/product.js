document.addEventListener('DOMContentLoaded', function () {
    const buyButton = document.querySelector('.buy-button');
    const cartModal =   new bootstrap.Modal(document.querySelector('.modal'));
    cartModal._element.setAttribute('inert', '');

    buyButton.addEventListener('click', function (event) {
        event.preventDefault();
        cartModal.show();
    });

    cartModal._element.addEventListener('show.bs.modal', function (){
        cartModal._element.removeAttribute('inert');
    });
    cartModal._element.addEventListener('hide.bs.modal', function (){
        cartModal._element.setAttribute('inert', '');
    });

});
