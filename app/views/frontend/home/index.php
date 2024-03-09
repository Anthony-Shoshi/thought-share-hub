<?php include __DIR__ . '/../inc/header.php'; ?>

<?php include __DIR__ . '/../inc/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <h2>Featured Blog</h2>
            <hr>
            <div id="featuredPostsContainer" class="row"></div>
        </div>

        <?php include __DIR__ . '/../inc/sidebar.php'; ?>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h2>More Blog</h2>
            <hr>
            <div id="moreBlogContainer" class="row"></div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/../inc/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchAndRenderPosts('/api/post/getAllFeaturedPostsApi', 'featuredPostsContainer');
        fetchAndRenderPosts('/api/post/getAllPostsLimitApi', 'moreBlogContainer');
    });
</script>