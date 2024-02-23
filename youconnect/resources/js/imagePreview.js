$(document).ready(function () {
    var input = $('#file_input');

    input.on('change', e => {
        var file = e.target.files[0];
        displayPreview(file);
    });
});

function displayPreview(file) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        var previewContainer = $('#preview-container');
        var preview = $('#preview');
        preview.prop('src', reader.result);
        console.log(reader);
        previewContainer.removeClass('hidden'); 
    };
}
