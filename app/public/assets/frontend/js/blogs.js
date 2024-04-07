const urlParams = new URLSearchParams(window.location.search);
const keyword = urlParams.get('keyword');
document.getElementById('searchKeyword').value = keyword;
if (keyword) {
    fetchAndRenderPosts(`/api/post/getSearchPostsApi?keyword=${encodeURIComponent(keyword)}`, 'allPostsContainer', keyword);
} else {
    fetchAndRenderPosts('/api/post/getAllPostsApi', 'allPostsContainer');
}