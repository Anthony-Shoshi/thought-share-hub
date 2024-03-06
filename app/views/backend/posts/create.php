<?php include __DIR__ . '/../inc/header.php'; ?>

<?php include __DIR__ . '/../inc/sidebar.php'; ?>

<div class="container mt-4">

    <?php include __DIR__ . '/../inc/message.php'; ?>

    <h2>Create Post</h2>
    <hr>

    <form method="post" action="/post/store" enctype="multipart/form-data" autocomplete="off">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="col-md-6">
                <label for="image_url" class="form-label">Image</label>
                <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea class="form-control" id="short_description" name="short_description" rows="5" required></textarea>
            </div>
            <div class="col-md-6">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="is_featured" name="is_featured">
                    <label class="form-check-label" for="is_featured">
                        Is Featured
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>

</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>