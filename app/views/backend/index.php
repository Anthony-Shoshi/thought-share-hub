<?php include __DIR__ . '/inc/header.php'; ?>


<?php include __DIR__ . '/inc/sidebar.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-4 dashboard-main">
    <div class="row">
        <div class="col-md-6">
            <a href="/post" class="text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Posts</h5>
                        <p class="card-text"><?= $totalPosts ?></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="/category" class="text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Categories</h5>
                        <p class="card-text"><?= $totalCategories ?></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</main>

<?php include __DIR__ . '/inc/footer.php'; ?>