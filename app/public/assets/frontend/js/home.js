document.addEventListener('DOMContentLoaded', function () {
    fetchAndRenderPosts('/api/post/getAllFeaturedPostsApi', 'featuredPostsContainer');
    fetchAndRenderPosts('/api/post/getAllPostsLimitApi', 'moreBlogContainer');
});
