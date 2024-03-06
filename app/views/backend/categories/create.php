<?php include __DIR__ . '/../inc/header.php'; ?>

<?php include __DIR__ . '/../inc/sidebar.php'; ?>

<div class="container mt-4">

    <?php include __DIR__ . '/../inc/message.php'; ?>

    <h2>Create Category</h2>
    <hr>

    <form method="post" action="/category/store" autocomplete="off">
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>

</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>