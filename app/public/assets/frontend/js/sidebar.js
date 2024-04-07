document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/category/getAllCategoryApi')
        .then(response => response.json())
        .then(categories => {
            const categoryList = document.getElementById('categoryList');
            categories.forEach(category => {
                const listItem = document.createElement('li');
                listItem.className = 'sidebar-list-item';
                
                const categoryLink = document.createElement('a');
                categoryLink.href = '/home/category?cat=' + category.slug;
                categoryLink.className = 'category-link text-decoration-none';
                categoryLink.textContent = category.category_name;

                listItem.appendChild(categoryLink);
                categoryList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error fetching categories:', error));
});