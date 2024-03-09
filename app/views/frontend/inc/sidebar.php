<div class="col-lg-4 col-md-4">
    <div class="card my-4 sidebar-card">
        <h5 class="card-header sidebar-header">Categories</h5>
        <div class="card-body">
            <ul id="categoryList" class="list-unstyled mb-0 sidebar-list">
            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api/category/getAllCategoryApi')
            .then(response => response.json())
            .then(categories => {
                const categoryList = document.getElementById('categoryList');
                categories.forEach(category => {
                    const listItem = document.createElement('li');
                    listItem.className = 'sidebar-list-item';
                    
                    const categoryLink = document.createElement('a');
                    categoryLink.href = '/home/category?catid=' + category.category_id;
                    categoryLink.className = 'category-link text-decoration-none';
                    categoryLink.textContent = category.category_name;

                    listItem.appendChild(categoryLink);
                    categoryList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error fetching categories:', error));
    });
</script>