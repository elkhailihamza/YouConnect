$(document).on('click', '.copy', function () {
    var copy = $(this).data('post-id');
    copyElement(this);
});

function copyElement(element) {
    console.log(element);
    var copyText = this;
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
}