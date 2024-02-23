$(document).ready(function () {
    $('.submit-comment').on('click', submitComment);
    $('.load-comments').on('click', loadComments);
});

// var nextPageUrl = '{{ $comments->nextPageUrl() }}';
// var isLoading = false;
// var scrollTimer;

// $('.comments-container').scroll(function () {
//     if ($('.comments-container').scrollTop() == $(document).height() - $('.comments-container').height()) {
//         clearTimeout(scrollTimer);
//         var $this = $(this);

//         scrollTimer = setTimeout(function () {
//             // Check for scroll stop and trigger load
//             var scrollHeight = $this.prop('scrollHeight');
//             var scrollTop = $this.scrollTop();
//             var modalHeight = $this.outerHeight();

//             if (scrollHeight - scrollTop <= modalHeight && !isLoading && nextPageUrl) {
//                 isLoading = true;

//                 // Show loading indicator here if needed

//                 // Fetch next set of comments
//                 fetch(nextPageUrl)
//                     .then(response => response.json())
//                     .then(data => {
//                         console.log('Fetched data:', data);

//                         // Append the comments
//                         appendComments(data.comments.data);

//                         // Update nextPageUrl with the correct key from the server response
//                         nextPageUrl = data.nextPageUrl;

//                         isLoading = false;
//                         // Hide loading indicator here if needed
//                     })
//                     .catch(error => {
//                         console.error('Error:', error);
//                         isLoading = false;
//                         // Handle error and hide loading indicator if needed
//                     });
//             }
//         }, 250);
//     }
// });

function submitComment() {
    var postId = $(this).data('post-id');
    var content = $('.comment-content[data-post-id="' + postId + '"]').val();

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
            $('.comment-content[data-post-id="' + postId + '"]').val('');
            var newCommentHtml = generateCommentHtml(data.comment);
            $('.comments-container[data-post-id="' + postId + '"]').prepend(newCommentHtml);
            $('.comment-count[data-post-id="' + postId + '"]').html(data.count);
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}

var fetchedPosts = new Map;

function loadComments() {
    var postId = $(this).data('post-id');

    if (fetchedPosts.has(postId)) {
        return;
    }

    $.ajax({
        url: '/posts/' + postId + '/comments',
        type: 'GET',
        success: function (data) {
            if (data.comments.data.length > 0) {
                fetchedPosts.set(postId, true);
                appendComments(data.comments.data);
            }
        },
        error: function (error) {
            console.error('Error:', error);
        },
    });
}

function appendComments(comments) {
    if (comments.length > 0) {
        var commentsContainer = $('.comments-container[data-post-id="' + comments[0].post_id + '"]');
        var commentsHtml = comments.map(generateCommentHtml).join('');
        commentsContainer.append(commentsHtml);
    }
}

function generateCommentHtml(comment) {
    var date = new Date(comment.created_at);
    var formattedDate = date.toLocaleString();
    var commentHtml = `
    <div class="comment p-3">
        <div class="flex self-start justify-self-start w-40">
            <img src="${!comment.avatar ? 'https://via.placeholder.com/50' : 'storage/' + comment.avatar}" alt="User"
                class="w-8 h-8 rounded-full mr-2">
            <div class="grid">
                <div><span class="dark:text-white text-[15px] font-medium">${comment.name}</span></div>
                <span class="text-[13px] w-44 text-stone-500">${formattedDate}</span>
            </div>
        </div>
        <div class="flex justify-between mt-1">
            <h2 class="text-[13px] ms-5 break-all w-full">${comment.content}</h2>
        </div>
    </div>
    <div class="flex justify-center">
        <hr class="w-96">
    </div>`;

    return commentHtml;
}
