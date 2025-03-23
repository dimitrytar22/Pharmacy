import "https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js";

ClassicEditor.create(document.querySelector('#editor')).catch(error => console.error(error));

let featureCount = 1;
document.getElementById('add-feature-btn').addEventListener('click', () => {
    const container = document.getElementById('features-container');
    const newFeature = document.createElement('div');
    newFeature.classList.add('input-group', 'mb-2', 'feature-item');
    newFeature.innerHTML = `
                <input type="text" name="features[${featureCount}][title]" class="form-control" placeholder="Title">
                <input type="text" name="features[${featureCount}][description]" class="form-control" placeholder="Description">
                <button type="button" class="btn btn-danger remove-feature-btn">-</button>
            `;
    container.appendChild(newFeature);
    featureCount++;
});

document.getElementById('features-container').addEventListener('click', (event) => {
    if (event.target.classList.contains('remove-feature-btn')) {
        event.target.closest('.feature-item').remove();
    }
});
