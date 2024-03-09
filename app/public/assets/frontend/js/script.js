function fetchAndRenderPosts(apiUrl, containerId) {
    fetch(apiUrl)
        .then(response => response.json())
        .then(posts => {
            const container = document.getElementById(containerId);
            container.innerHTML = '';

            posts.forEach(post => {
                const postElement = document.createElement('div');
                postElement.className = containerId === 'moreBlogContainer' ? 'col-lg-4' : 'col-lg-6';
                postElement.innerHTML = `
                                        <!-- Featured Post -->
                                        <div class="post-preview">
                                            <a href="/home/blog?id=${post.post_id}" class="text-decoration-none">
                                                <!-- Add a class to the image for styling -->
                                                <img src="${post.image_url}" alt="Post Image" class="img-fluid rounded fixed-size-image">
                                                <h2 class="post-title">${truncateString(post.title, 40)}</h2>
                                                <p class="post-subtitle">${truncateString(post.short_description, 90)}</p>
                                            </a>
                                            <p class="post-meta">
                                                <i class="bi bi-person"></i>
                                                <span class="text-primary">${post.author}</span>
                                                <br>on ${post.created_at}
                                            </p>
                                        </div>
                                    `;

                container.appendChild(postElement);
            });
        })
        .catch(error => console.error('Error fetching posts:', error));
}

function fetchAndRenderCategoryPosts(apiUrl, containerId) {
    fetch(apiUrl)
        .then(response => response.json())
        .then(posts => {
            const container = document.getElementById(containerId);
            container.innerHTML = '';

            if (posts.length === 0) {
                const noPostMessage = document.createElement('div');
                noPostMessage.className = 'alert alert-warning';
                noPostMessage.textContent = 'There are no posts in this category.';
                container.appendChild(noPostMessage);
            } else {
                posts.forEach(post => {
                    const postElement = document.createElement('div');
                    postElement.className = 'col-lg-6';
                    postElement.innerHTML = `<!-- Featured Post -->
                                                <div class="post-preview">
                                                    <a href="/home/blog?id=${post.post_id}" class="text-decoration-none">
                                                        <img src="${post.image_url}" alt="Post Image" class="img-fluid rounded">
                                                        <h2 class="post-title">${post.title}</h2>
                                                        <p class="post-subtitle">${post.short_description}</p>
                                                    </a>
                                                    <p class="post-meta">
                                                        <i class="bi bi-person"></i>
                                                        <span class="text-primary">${post.author}</span>
                                                        <br>on ${post.created_at}
                                                    </p>
                                                </div>
                                            `;
                    container.appendChild(postElement);
                });
            }
        })
        .catch(error => console.error('Error fetching posts:', error));
}

function truncateString(str, maxLength) {
    if (str.length > maxLength) {
        return str.slice(0, maxLength - 3) + '...';
    } else {
        return str;
    }
}

//Post Details 
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const postId = urlParams.get('id');
    const commentForm = document.querySelector(".comment-form");
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

                    fetchComments(postId);
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
});

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

function fetchComments(postId) {
    fetch(`/api/comment/getAllCommentsByPostId?id=${postId}`)
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