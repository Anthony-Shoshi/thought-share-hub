<?php include __DIR__ . '/inc/header.php'; ?>

<?php include __DIR__ . '/inc/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <h2><?= $categoryName ?> - Blogs</h2>
            <hr>

            <div id="categoryPostsContainer" class="row"></div>

        </div>

        <?php include __DIR__ . '/inc/sidebar.php'; ?>
    </div>
</div>


<?php include __DIR__ . '/inc/footer.php'; ?>

<script src="/assets/frontend/js/category-blogs.js"></script>