$(document).ready(function () {
    $('.submit-comment').on('click', submitComment);
    $('.load-comments').on('click', loadComments);
});

let nextPageUrl = '{{ $comments->nextPageUrl() }}';
let isLoading = false;
var scrollTimer;


$('.comments-container').scroll(function () {
    if ($('.comments-container').scrollTop() == $(document).height() - $('.comments-container').height()) {
        clearTimeout(scrollTimer);
        var $this = $(this);

        scrollTimer = setTimeout(function () {
            // Check for scroll stop and trigger load
            var scrollHeight = $this.prop('scrollHeight');
            var scrollTop = $this.scrollTop();
            var modalHeight = $this.outerHeight();

            if (scrollHeight - scrollTop <= modalHeight && !isLoading && nextPageUrl) {
                isLoading = true;

                // Show loading indicator here if needed

                // Fetch next set of comments
                fetch(nextPageUrl)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Fetched data:', data);

                        // Append the comments
                        appendComments(data.comments.data);

                        // Update nextPageUrl with the correct key from the server response
                        nextPageUrl = data.nextPageUrl;

                        isLoading = false;
                        // Hide loading indicator here if needed
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        isLoading = false;
                        // Handle error and hide loading indicator if needed
                    });
            }
        }, 250);
    }
});


function submitComment() {
    var postId = $(this).data('post-id');
    var content = $('.comment-content').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/posts/' + postId + '/comments/store',
        type: 'POST',
        data: {
            content: content
        },
        success: function (data) {
            $('.comment-content').val('');
            $('.comment-count[data-post-id="' + postId + '"]').html(data.count);
        },
        error: function (error) {
            console.error('Error:', error);
            // Handle error if needed
        }
    });
}

function loadComments() {
    var postId = $(this).data('post-id');
    $('.load-comments[data-post-id="' + postId + '"]').addClass('hidden');

    $.ajax({
        url: '/posts/' + postId + '/comments',
        type: 'GET',
        success: function (data) {
            appendComments(data.comments.data);
            nextPageUrl = getNextPageUrl(data);
        },
        error: function (error) {
            console.error('Error:', error);
            // Handle error if needed
        }
    });
}

function appendComments(comments) {
    if (comments.length > 0) {
        var commentsContainer = $('.comments-container[data-post-id="' + comments[0].post_id + '"]');
        comments.forEach(function (comment) {
            commentsContainer.append(generateCommentHtml(comment));
        });
    }
}

function generateCommentHtml(comment) {
    var date = new Date(comment.created_at);
    var formattedDate = date.toLocaleString();
    var commentHtml = `
        <div class="comment p-3 bg-gray-800">
            <div class="flex self-start justify-self-start w-40">
                <img src="https://via.placeholder.com/50" alt="User" class="w-[40px] h-[40px] rounded-full mr-2">
                <div class="grid">
                    <div><span class="dark:text-white text-[15px] font-medium">${comment.username}</span></div>
                    <span class="text-[13px] w-44 text-stone-500">${formattedDate}</span>
                </div>
            </div>
            <div class="flex justify-between mt-1">
                <h2 class="text-[13px] ms-5 break-all w-full">${comment.content}</h2>
            </div>
        </div>
        <hr>`;
    return commentHtml;
}

function getNextPageUrl(data) {
    let parser = new DOMParser();
    let doc = parser.parseFromString(data, 'text/html');
    let nextPageUrlElement = doc.querySelector('a[rel="next"]');
    return nextPageUrlElement ? nextPageUrlElement.getAttribute('href') : null;
}