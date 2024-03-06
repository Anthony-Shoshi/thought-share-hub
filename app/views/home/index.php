<?php include __DIR__ . '/../inc/header.php'; ?>

<?php include __DIR__ . '/../inc/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <h2>Featured Blog</h2>
            <hr>

            <!-- Featured Posts Container -->
            <div id="featuredPostsContainer" class="row"></div>

            <!-- More Blog Section -->
            <h2>More Blog</h2>
            <hr>

            <!-- More Blog Container -->
            <div id="moreBlogContainer" class="row"></div>

        </div>

        <?php include __DIR__ . '/../inc/sidebar.php'; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchAndRenderPosts('/post/getAllFeaturedPostsApi', 'featuredPostsContainer');
        fetchAndRenderPosts('/post/getAllPostsLimitApi', 'moreBlogContainer');
    });
</script>

<?php include __DIR__ . '/../inc/footer.php'; ?>