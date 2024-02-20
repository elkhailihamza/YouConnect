$(document).ready(function () {
    $('.submit-comment').on('click', function () {
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
                $('.comment-count[data-post-id="' + postId + '"]').html(data.count);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
    $('.load-comments').on('click', function () {
        var postId = $(this).data('post-id');
        $('.load-comments[data-post-id="' + postId + '"]').addClass('hidden');

        $.ajax({
            url: '/posts/' + postId + '/comments',
            type: 'GET',
            success: function (data) {
                let comments = data.comments.data;
                var commentsHtml = generateCommentHtml(comments);
                $('.comments-container[data-post-id="' + postId + '"]').html(commentsHtml);
                nextPageUrl = data.comments.next_page_url;
            }
        });
    });
});

let nextPageUrl = '{{ $comments->nextPageUrl() }}';
let isLoading = false;

window.addEventListener('scroll', () => {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight && !isLoading && nextPageUrl) {
        isLoading = true;
        fetch(nextPageUrl)
            .then(response => response.text())
            .then(data => {
                document.getElementById('comments-list').innerHTML += generateCommentHtml(data.comments.data);
                nextPageUrl = data.comments.next_page_url;
                isLoading = false;
            });
    }
});

function getNextPageUrl(html) {
    let parser = new DOMParser();
    let doc = parser.parseFromString(html, 'text/html');
    let nextPageUrl = doc.querySelector('a[rel="next"]');
    return nextPageUrl ? nextPageUrl.getAttribute('href') : null;
}

function generateCommentHtml(comments) {
    var commentsHtml = '';

    comments.forEach(function (comment) {
        var date = new Date(comment.created_at);
        var formattedDate = date.toLocaleString();
        commentsHtml += '<div class="p-3 bg-gray-800">';
        commentsHtml += '<div class="flex self-start justify-self-start w-40">';
        commentsHtml += '<img src="https://via.placeholder.com/50" alt="User" class="w-[40px] h-[40px] rounded-full mr-2">';
        commentsHtml += '<div class="grid">';
        commentsHtml += '<div><span class="dark:text-white text-[15px] font-medium">' + comment.username + '</span></div>';
        commentsHtml += '<span class="text-[13px] w-44 text-stone-500">' + formattedDate + '</span>';
        commentsHtml += '</div>';
        commentsHtml += '</div>';
        commentsHtml += '<div class="flex justify-between ms-2 mt-1">';
        commentsHtml += '<h2 class="text-[13px] ms-5">' + comment.content + '</h2>';
        commentsHtml += '<hr>';
        commentsHtml += '</div>';
        commentsHtml += '</div>';
    });

    return commentsHtml;
}