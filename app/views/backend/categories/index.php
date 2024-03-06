<?php include __DIR__ . '/../inc/header.php'; ?>

<?php include __DIR__ . '/../inc/sidebar.php'; ?>

<div class="container mt-4">

    <?php include __DIR__ . '/../inc/message.php'; ?>

    <h2>Category List</h2>
    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $index => $category) : ?>
                <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $category->category_name ?></td>
                    <td>
                        <a href="/category/edit?id=<?= $category->category_id ?>" class="btn btn-primary">Edit</a>
                        <a href="/category/delete?id=<?= $category->category_id ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>