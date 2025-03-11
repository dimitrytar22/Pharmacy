document.addEventListener('DOMContentLoaded', function () {
    const buyButton = document.querySelector('.buy-button');

    buyButton.addEventListener('click', function (event) {
        event.preventDefault();
        console.log('added to cart')
    });



});
