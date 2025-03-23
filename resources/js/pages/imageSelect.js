document.addEventListener('DOMContentLoaded', function () {
    const chooseImage = document.querySelector('.image-select');
    const selectedImage = document.querySelector('.selected-image');
    const imageErrorBlock = document.querySelector('.image-error');

    chooseImage.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file.type.split('/')[0] !== 'image') {
            chooseImage.value = "";
            selectedImage.setAttribute('hidden', '');
            imageErrorBlock.removeAttribute('hidden');
            return;
        }
        selectedImage.removeAttribute('hidden');
        imageErrorBlock.setAttribute('hidden', '');

        selectedImage.src = URL.createObjectURL(file);

    });
});
