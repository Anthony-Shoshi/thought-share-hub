<?php include __DIR__ . '/inc/header.php'; ?>

<?php include __DIR__ . '/inc/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <h2><?= $categoryName ?> - Blog</h2>
            <hr>

            <div id="categoryPostsContainer" class="row"></div>

        </div>

        <?php include __DIR__ . '/inc/sidebar.php'; ?>
    </div>
</div>

<script>
    function fetchAndRenderPosts(apiUrl, containerId) {
        fetch(apiUrl)
            .then(response => response.json())
            .then(posts => {
                const container = document.getElementById(containerId);
                container.innerHTML = '';

                posts.forEach(post => {
                    const postElement = document.createElement('div');
                    postElement.className = 'col-lg-6';
                    postElement.innerHTML = `
                        <!-- Featured Post -->
                        <div class="post-preview">
                            <a href="/home/blog?id=${post.post_id}" class="text-decoration-none">
                                <img src="${post.image_url}" alt="Post Image" class="img-fluid rounded">
                                <h2 class="post-title">${post.title}</h2>
                                <p class="post-subtitle">${post.short_description}</p>
                            </a>
                            <p class="post-meta">
                                <i class="bi bi-person"></i>
                                <span class="text-primary">${post.author}</span>
                                <br>on ${post.created_at}
                            </p>
                        </div>
                    `;

                    container.appendChild(postElement);
                });
            })
            .catch(error => console.error('Error fetching posts:', error));
    }

    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = urlParams.get('catid');

    fetchAndRenderPosts('/post/getAllPostsByCategoryId?catid=' + categoryId, 'categoryPostsContainer');
</script>

<?php include __DIR__ . '/inc/footer.php'; ?>