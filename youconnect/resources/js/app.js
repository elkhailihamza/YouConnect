import './bootstrap';

$(document).on('click', '.copy', function () {
    var copy = $(this).data('post-link');
    copyElement(copy);
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Copied successfully!",
        showConfirmButton: false,
        timer: 1500
    });
});
const leftSidebar = document.getElementById('left-sidebar');
const rightSidebar = document.getElementById('right-sidebar');
const toggleLeftSidebar = document.getElementById('toggle-left-sidebar');
const toggleRightSidebar = document.getElementById('toggle-right-sidebar');

toggleLeftSidebar.addEventListener('click', () => {
    leftSidebar.classList.toggle('open');

    if (rightSidebar.classList.contains('open')) {
        rightSidebar.classList.remove('open');
    }
});

toggleRightSidebar.addEventListener('click', () => {
    rightSidebar.classList.toggle('open');

    if (leftSidebar.classList.contains('open')) {
        leftSidebar.classList.remove('open');
    }
});

function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.remove('m-0');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.add('m-0');
}

function copyElement(element) {
    var copyText = element;
    navigator.clipboard.writeText(copyText);
}