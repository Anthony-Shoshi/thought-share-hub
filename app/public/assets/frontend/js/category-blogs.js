const urlParams = new URLSearchParams(window.location.search);
const slug = urlParams.get('cat');
fetchAndRenderCategoryPosts('/api/post/getAllPostsByCategory?cat=' + slug, 'categoryPostsContainer');

function fetchAndRenderCategoryPosts(apiUrl, containerId) {
    fetch(apiUrl)
        .then(response => response.json())
        .then(posts => {
            const container = document.getElementById(containerId);
            container.innerHTML = '';

            if (posts.length === 0) {
                const noPostMessage = document.createElement('div');
                noPostMessage.className = 'alert alert-warning';
                noPostMessage.textContent = 'There are no posts in this category.';
                container.appendChild(noPostMessage);
            } else {
                posts.forEach(post => {
                    const postElement = document.createElement('div');
                    postElement.className = 'col-lg-6';
                    postElement.innerHTML = `<!-- Featured Post -->
                                                <div class="post-preview">
                                                    <a href="/home/blog?slug=${post.slug}" class="text-decoration-none">
                                                        <img src="${post.image_url}" alt="Post Image" class="img-fluid rounded fixed-size-image">
                                                        <h2 class="post-title">${truncateString(post.title, 35)}</h2>
                                                        <p class="post-subtitle">${truncateString(post.short_description, 80)}</p>
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
            }
        })
        .catch(error => console.error('Error fetching posts:', error));
}