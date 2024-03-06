document.addEventListener('DOMContentLoaded', function () {
    // Get the current URL
    var currentUrl = window.location.pathname;

    // Get all the navigation links
    var navLinks = document.querySelectorAll('.nav-link');

    // Iterate through each link and check if the URL matches
    navLinks.forEach(function (link) {
        // Get the href attribute of the link
        var href = link.getAttribute('href');

        // Compare the href with the current URL
        if (href === currentUrl) {
            // Remove 'active' class from all links
            navLinks.forEach(function (navLink) {
                navLink.parentNode.classList.remove('active');
            });

            // Add the 'active' class to the parent 'nav-item'
            link.parentNode.classList.add('active');
        }
    });
});

function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
}

document.getElementById('post-list').addEventListener('change', function() {
    var postId = this.value;
    if (postId !== '') {
        window.location.href = '/comment/index?id=' + postId;
    }
});
