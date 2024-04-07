document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get('slug');
    const commentForm = document.querySelector(".comment-form");

    fetchComments(slug);
    storeComments(slug, commentForm);
});

function storeComments(slug, commentForm) {
    if (commentForm) {
        commentForm.addEventListener("submit", function (event) {
            event.preventDefault();
            const formData = new FormData(commentForm);
            fetch(commentForm.getAttribute("action"), {
                method: "POST",
                body: formData,
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        commentForm.reset();

                        const successMessage = document.querySelector('.success-message');
                        successMessage.classList.remove('d-none');
                        successMessage.classList.add('d-block');

                        const errorMessages = commentForm.querySelectorAll(".error-message");
                        errorMessages.forEach(message => message.remove());

                        fetchComments(slug);
                    } else {
                        Object.keys(data.errors).forEach(fieldName => {
                            const field = document.querySelector(`#${fieldName}`);
                            const errorMessage = document.createElement("p");
                            errorMessage.className = "error-message";
                            errorMessage.textContent = data.errors[fieldName];
                            errorMessage.style.color = "red";
                            field.parentNode.insertBefore(errorMessage, field.nextSibling);
                        });
                    }
                })
                .catch(error => {
                    console.error("Error during comment submission", error);
                });
        });
    }
}

function fetchComments(slug) {
    fetch(`/api/comment/getAllCommentsByPostId?slug=${slug}`)
        .then(response => response.json())
        .then(comments => {
            renderComments(comments);
        })
        .catch(error => {
            console.error('Error fetching comments:', error);
        });
}


function renderComments(comments) {
    const commentsContainer = document.getElementById('commentsContainer');
    commentsContainer.innerHTML = '';

    if (comments.length > 0) {
        comments.forEach(comment => {
            const commentElement = document.createElement('div');
            commentElement.className = 'comment';
            commentElement.innerHTML = `
            <p>${comment.comment_text}</p>
            <p class="comment-meta">Commented by <b>${comment.name}</b> on <b>${comment.created_at}</b></p>
        `;
            commentsContainer.appendChild(commentElement);
        });
    } else {
        commentsContainer.innerHTML = '<p>No comments on this post.</p>';
    }
}

let hasLiked = false;

function toggleLike(icon) {
    if (!hasLiked) {
        const postId = icon.getAttribute('data-post-id');
        const ip = icon.getAttribute('data-ip');

        fetch('/api/like/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                post_id: postId,
                ip: ip,
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const likesCountElement = document.getElementById('likesCount');
                    const currentLikes = parseInt(likesCountElement.textContent, 10);
                    likesCountElement.textContent = currentLikes + 1;
                    hasLiked = true;
                } else {
                    const alreadyLikedMessage = document.querySelector('.already-liked-message');
                    alreadyLikedMessage.classList.remove('d-none');
                    alreadyLikedMessage.classList.add('d-block');
                }
            })
            .catch(error => {
                console.error('Error during like action', error);
            });
    } else {
        const alreadyLikedMessage = document.querySelector('.already-liked-message');
        alreadyLikedMessage.classList.remove('d-none');
        alreadyLikedMessage.classList.add('d-block');
    }
}