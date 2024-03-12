<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Thought Share Hub</a>

        <div class="mx-auto">
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="navbarDropdownMenu">
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/home/blogs">All Blogs</a>
                    </li>
                </ul>
            </div>
        </div>

        <div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <form id="searchForm" class="form-inline" autocomplete="off">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchKeyword" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text" id="basic-addon2">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
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
</script>