import axios from "axios";

var fetchedUsers = false;
var timeout;
$(document).ready(function () {
    $('#explorerTab').on('click', function () {
        if (fetchedUsers) {
            return;
        }
        loadUsers();
        fetchedUsers = true;
    });
    $('#searchBar').on('keyup', function () {
        clearTimeout(timeout);

        timeout = setTimeout(function () {
            loadUsers();
        }, 250);
    });
});

$(document).on('click', '.addFriend', function () {
    var friendId = $(this).data('friend-id');
    sendFriendRequest(this);
});

function sendFriendRequest(btn) {
    var friendId = btn.getAttribute('data-friend-id');

    axios.get('/sendrequest/' + friendId)
        .then(function (response) {
            $(btn).prop('hidden', true).after('<span class="dark:text-white">sent!</span>');
        })
        .catch(function (error) {
            console.log(error);
        });
}

function loadUsers() {
    var search = $('#searchBar').val();

    axios.get('/users/get', {
        params: {
            search: search
        }
    })
        .then(function (response) {
            $('#user-container').empty();
            appendUsers(response.data.users.data, response.data.mainUserId);
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
}


function appendUsers(users, mainId) {
    if (users.length > 0) {
        var userContainer = $('#user-container');
        users.forEach(function (user) {
            userContainer.append(generateUserHtml(user, mainId));
        });
    }
}

function generateUserHtml(user, mainId) {
    var userHtml = `
    <div class="flex justify-between select-none">
        <div>
            <div class="flex self-start justify-self-start w-40">
                <img src="${!user.avatar ? 'https://via.placeholder.com/50' : '../storage/' + user.avatar}" alt="User"
                    class="w-8 h-8 rounded-full mr-2">
                <div class="w-full">
                    <div><span class="dark:text-white text-[15px] font-medium">${user.name}</span></div>
                </div>
            </div>
            <div>
                <h2 class="text-[13px] text-dark dark:text-white ms-10 break-all w-full">${!user.bio ? '<span class="text-[#]">No Bio</span>' : user.bio}</h2>
            </div>
        </div>
        <div>
            <button data-friend-id="${user.id}" class="addFriend bg-blue-700 p-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            </button>
        </div>
    </div>
    <div class="flex justify-center">
        <hr class="w-96">
    </div>`;

    return userHtml;
}