<?php include __DIR__ . '/../inc/header.php'; ?>

<?php include __DIR__ . '/../inc/sidebar.php'; ?>

<div class="container mt-4">

    <?php include __DIR__ . '/../inc/message.php'; ?>

    <h2>Comment List <?= $postTitle ?></h2>
    <hr>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <select name="post_id" id="post-list" class="form-control">
                    <option value="">Select Post</option>
                    <?php foreach ($posts as $post) : ?>
                        <option value="<?= $post->post_id ?>"><?= $post->title ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Comment</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($comments)) : ?>
                <tr>
                    <td colspan="5" class="text-center">No content found</td>
                </tr>
            <?php else : ?>
                <?php foreach ($comments as $index => $comment) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= $comment->name ?></td>
                        <td><?= $comment->email ?></td>
                        <td><?= $comment->comment_text ?></td>
                        <td>
                            <a href="/comment/delete?id=<?= $comment->comment_id ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>