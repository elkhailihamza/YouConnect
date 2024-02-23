const axios = require('axios').default;
$(document).ready(function () {
    var fetchedUsers = false;
    $('#explorerTab').on('click', loadUsers);
});

function loadUsers() {

    if (fetchedUsers) {
        return;
    }

    axios.get('/users/get')
        .then(function (response) {
            fetchedUsers = true;
            var user =
                $('#users').prepend();
        })
        .catch(function (error) {
            console.log(error);
        })
}

function generateUser(user) {
    var userHtml =
        `

    `;
}

function search() {

}