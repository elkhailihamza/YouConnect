import './bootstrap';


const leftSidebar = document.getElementById('left-sidebar');
const rightSidebar = document.getElementById('right-sidebar');
const toggleLeftSidebar = document.getElementById('toggle-left-sidebar');
const toggleRightSidebar = document.getElementById('toggle-right-sidebar');
const inputBtn = document.getElementById('file-upload-button');

if (inputBtn) {
    inputBtn.remove();
}

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