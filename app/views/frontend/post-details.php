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
                        <span id="likesCount"><?= $details->total_likes ?></span> Likes
                        <br>
                        <span class="d-none text-danger already-liked-message">You have already liked!</span>
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

                    <div id="commentsContainer"></div>

                    <br>

                    <h4>Leave a Comment</h4>
                    <p class="d-none text-success success-message" style="color: green;">Thank you for your comment!</p>
                    <form class="comment-form" method="post" action="/api/comment/store">
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

<?php include __DIR__ . '/inc/footer.php'; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const slug = urlParams.get('slug');
        fetchComments(slug);
    });
</script>