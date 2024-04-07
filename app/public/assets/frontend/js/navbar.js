document.addEventListener("DOMContentLoaded", function() {
    fetch('/api/category/getAllCategoryApi')
        .then(response => response.json())
        .then(categories => {
            const dropdownMenu = document.getElementById('navbarDropdownMenu');

            categories.forEach(category => {
                const dropdownItem = document.createElement('a');
                dropdownItem.className = 'dropdown-item';
                dropdownItem.href = '/home/category?cat=' + category.slug;
                dropdownItem.textContent = category.category_name;
                dropdownMenu.appendChild(dropdownItem);
            });
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
        });

    const searchForm = document.getElementById('searchForm');
    searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const searchKeyword = document.getElementById('searchKeyword').value;
        window.location.href = `/home/blogs?keyword=${encodeURIComponent(searchKeyword)}`;
    });
});