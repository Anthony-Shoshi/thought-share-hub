<?php include __DIR__ . '/../inc/header.php'; ?>

<?php include __DIR__ . '/../inc/sidebar.php'; ?>

<div class="container mt-4">

    <?php include __DIR__ . '/../inc/message.php'; ?>

    <h2>Post List</h2>
    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Short Description</th>
                <th scope="col">Featured</th>
                <th scope="col">Total Like</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $index => $post) : ?>
                <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $post->title ?></td>
                    <td><?= $post->author ?></td>
                    <td><?= $post->short_description ?></td>
                    <td>
                        <?php if ($post->is_featured) : ?>
                            <span class="badge bg-success">Featured</span>
                        <?php else : ?>
                            <span class="badge bg-danger">Not Featured</span>
                        <?php endif; ?>
                    </td>

                    <td><?= $post->total_like ?></td>
                    <td>
                        <a href="/comment/index?id=<?= $post->post_id ?>" class="btn btn-info">View Comments</a>
                        <a href="/post/edit?id=<?= $post->post_id ?>" class="btn btn-primary">Edit</a>
                        <a href="/post/delete?id=<?= $post->post_id ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>