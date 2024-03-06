<?php include __DIR__ . '/inc/header.php'; ?>

<?php include __DIR__ . '/inc/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <?php if (!empty($details)) : ?>
                <h1><?= $details->title ?></h1>
                <p class="post-meta">Posted by
                    <?= $details->author ?>
                    on
                    <?= $details->created_at ?>
                </p>

                <div class="post-content">
                    <img src="<?= $details->image_url ?>" alt="Post Image" class="img-fluid mb-3">
                    <p><?= $details->content ?></p>

                    <p>
                        <i class="bi bi-hand-thumbs-up" role="button" data-post-id="<?= $details->post_id ?>" data-ip="<?= $_SERVER['REMOTE_ADDR'] ?>" onclick="toggleLike(this)"></i>
                        <span id="likesCount"><?= $details->total_likes ?></span> Claps
                    </p>

                    <div class="d-flex gap-3">
                        <span>Share on:</span>
                        <div>
                            <!-- Facebook Share Icon -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $currentUrl ?>" target="_blank" rel="noopener" class="text-primary">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </div>
                        <div>
                            <!-- Instagram Share Icon -->
                            <a href="https://www.instagram.com/?url=<?= $currentUrl ?>" target="_blank" rel="noopener" class="text-primary">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="comments-section">
                    <h3>Latest Comments</h3>

                    <?php if (!empty($comments)) : ?>
                        <?php foreach ($comments as $comment) : ?>
                            <div class="comment">
                                <p><?= $comment->comment_text ?></p>
                                <p class="comment-meta">Commented by <?= $comment->name ?> on <?= $comment->created_at ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No comments on this post.</p>
                    <?php endif; ?>

                    <br>

                    <h4>Leave a Comment</h4>
                    <form class="comment-form" method="post" action="/comment/store">
                        <input type="hidden" name="post_id" value="<?= $details->post_id ?>">
                        <div class="row mb-2">
                            <div class="form-group col-md-6">
                                <label for="name">Your Name:</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Your Email:</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment_text">Your Comment:</label>
                            <textarea class="form-control" name="comment_text" id="comment_text" rows="3" placeholder="Type your comment here"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>

                </div>

            <?php else : ?>
                <p>No details available for this post.</p>
            <?php endif; ?>

            <div class="related-posts-section">
                <h3>Related Posts</h3>

                <hr>

                <?php if (!empty($relatedPosts)) : ?>
                    <div class="row">
                        <?php foreach ($relatedPosts as $relatedPost) : ?>
                            <div class="col-md-4">
                                <a href="/home/blog?id=<?= $relatedPost->post_id ?>" class="text-decoration-none">
                                    <div class="related-post">
                                        <img src="<?= $relatedPost->image_url ?>" alt="Related Post Image" class="img-fluid mb-3">
                                        <h4><?= $relatedPost->title ?></h4>
                                        <p class="post-meta"><i class="bi bi-person"></i><?= $relatedPost->author ?></p>
                                        <p>on <?= $relatedPost->created_at ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p>No related posts found.</p>
                <?php endif; ?>

            </div>

        </div>

        <?php include __DIR__ . '/inc/sidebar.php'; ?>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const commentForm = document.querySelector(".comment-form");

        commentForm.addEventListener("submit", function(event) {
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

                        const successMessage = document.createElement("p");
                        successMessage.textContent = "Thank you for your comment!";
                        successMessage.style.color = "green";
                        commentForm.parentNode.insertBefore(successMessage, commentForm.nextSibling);

                        const errorMessages = commentForm.querySelectorAll(".error-message");
                        errorMessages.forEach(message => message.remove());
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

            fetch('/like/create', {
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
                    console.error('Failed to like the post.');
                }
            })
            .catch(error => {
                console.error('Error during like action', error);
            });
        } else {
            console.log('You have already liked this post.');
        }
    }
</script>




<?php include __DIR__ . '/inc/footer.php'; ?>