<?php include __DIR__ . '/inc/header.php'; ?>

<?php include __DIR__ . '/inc/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <h2>All Blogs</h2>
            <hr>

            <div id="allPostsContainer" class="row"></div>

        </div>

        <?php include __DIR__ . '/inc/sidebar.php'; ?>
    </div>
</div>


<?php include __DIR__ . '/inc/footer.php'; ?>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const keyword = urlParams.get('keyword');
    document.getElementById('searchKeyword').value = keyword;
    if (keyword) {
        fetchAndRenderPosts(`/api/post/getSearchPostsApi?keyword=${encodeURIComponent(keyword)}`, 'allPostsContainer', keyword);
    } else {
        fetchAndRenderPosts('/api/post/getAllPostsApi', 'allPostsContainer');
    }
</script>