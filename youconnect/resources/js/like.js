document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.likeButton').forEach(function (likeButton) {
        likeButton.addEventListener('click', function () {
            var post_id = this.getAttribute('data-post-id');
            var likeButtonElement = this;

            // Check if the user has already liked the post
            axios.post('/posts/check-like/' + post_id)
                .then(function (response) {
                    if (response.data.hasLiked) {
                        likeButtonElement.classList.add('liked');
                    } else {
                        // If the user hasn't liked the post, proceed with liking/unliking logic
                        if (likeButtonElement.classList.contains('liked')) {
                            // Unlike the post
                            axios.post('/posts/unlike', { post_id: post_id })
                                .then(function (response) {
                                    if (response.data.status === 'unliked') {
                                        likeButtonElement.classList.remove('liked');
                                        var likesCount = parseInt(likeButtonElement.querySelector('.likes-count').textContent);
                                        likeButtonElement.querySelector('.likes-count').textContent = likesCount - 1;
                                    } else {
                                        console.log('Error unliking post');
                                    }
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        } else {
                            // Like the post
                            axios.post('/posts/like', { post_id: post_id })
                                .then(function (response) {
                                    if (response.data.status === 'liked') {
                                        likeButtonElement.classList.add('liked');
                                        var likesCount = parseInt(likeButtonElement.querySelector('.likes-count').textContent);
                                        likeButtonElement.querySelector('.likes-count').textContent = likesCount + 1;
                                    } else {
                                        console.log('Error liking post');
                                    }
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        }
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    });
});
