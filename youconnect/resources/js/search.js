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
    $('#searchBar').on('keydown', function () {
        clearTimeout(timeout);

        timeout = setTimeout(function () {
            loadUsers();
        }, 125);
    });
});
$(document).on('click', '.addFriend', function () {
    var friendId = $(this).data('friend-id');
    sendFriendRequest(this);
});

$(document).on('click', '.removeFriend', function () {
    var friendId = $(this).data('friend-id');
    removeFriend(this);
});

function sendFriendRequest(btn) {
    var friendId = btn.getAttribute('data-friend-id');

    axios.post('/sendrequest/' + friendId)
        .then(function (response) {
            $(btn).prop('hidden', true).after('<span class="dark:text-white">sent!</span>');
        })
        .catch(function (error) {
            console.log(error);
        });
}

function removeFriend(btn) {
    var friendId = btn.getAttribute('data-friend-id');

    axios.post('/cancel-request/' + friendId)
        .then(function (response) {
            $(btn).prop('hidden', true).after('<span class="dark:text-white">removed!</span>');
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
            if (response.data.users.data.length > 0) {
                appendUsers(response.data.users.data, response.data.mainUserId);
            } else {
                $('#user-container').html(
                    '<div class="container text-center"><span class="text-dark dark:text-white">No users can be found!</span></div>'
                );
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

function checkFriendship(user) {
    if (user.pending) {
        return `
            <button data-friend-id="${user.id}" class="removeFriend bg-red-700 p-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            </button>
        `;
    }

    if (user.isFriend) {
        return `
            <a href="http://127.0.0.1:8000/chatify/${user.id}" class="messageFriend bg-green-700 p-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stro#FFFFFFb1ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
            </a>
            <button data-friend-id="${user.id}" class="removeFriend bg-red-700 p-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            </button>
        `;
    }

    if (!user.isFriend) {
        return `
            <button data-friend-id="${user.id}" class="addFriend bg-blue-700 p-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            </button>
        `;
    }
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
    const avatarSrc = user.avatar ? `../storage/${user.avatar}` : 'https://via.placeholder.com/50';
    const bioText = user.bio ? user.bio : '<span class="text-[#]">No Bio</span>';

    return `
        <div class="flex justify-between select-none">
            <div class="flex self-start justify-self-start w-40">
                <img src="${avatarSrc}" alt="User" class="w-8 h-8 rounded-full mr-2">
                <div class="w-full">
                    <div class=" w-40"><a href="/profile/${user.id}" class="dark:text-white text-[15px] w-40 font-medium">${user.name}</a></div>
                    <h2 class="text-[13px] text-stone-500 ms-2 break-all w-full">${bioText}</h2>
                </div>
            </div>
            <div>
                ${checkFriendship(user)}
            </div>
        </div>
        <div class="flex justify-center">
            <hr class="w-96">
        </div>
    `;
}
