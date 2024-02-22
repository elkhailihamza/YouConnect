document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btnlike').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route("like.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ post_id: postId })
            })
            .then(response => response.json())
            .then(data => {
                const likeButton = document.querySelector(`.btnlike[data-post-id="${postId}"] i`);
                const likesCount = document.querySelector(`.likeButton[data-post-id="${postId}"] .likes-count`);
                if (data.liked) {
                    likeButton.classList.add('text-red-500'); // Change la couleur du cœur en rouge
                } else {
                    likeButton.classList.remove('text-red-500'); // Retire la couleur rouge du cœur
                }
                likesCount.textContent = data.likesCount;
            })
            .catch(error => console.error('Error:', error));
        });
    });
});