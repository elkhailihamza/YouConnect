import './bootstrap';


const leftSidebar = document.getElementById('left-sidebar');
const rightSidebar = document.getElementById('right-sidebar');
const toggleLeftSidebar = document.getElementById('toggle-left-sidebar');
const toggleRightSidebar = document.getElementById('toggle-right-sidebar');
const toggllepublication = document.getElementById('publication');

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