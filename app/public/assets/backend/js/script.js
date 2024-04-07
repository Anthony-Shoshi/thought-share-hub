document.addEventListener('DOMContentLoaded', function () {
    var currentUrl = window.location.pathname;

    
    var navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(function (link) {
        var href = link.getAttribute('href');
        
        if (href === currentUrl) {
            navLinks.forEach(function (navLink) {
                navLink.classList.remove('active');
            });
            
            link.classList.add('active');
        }
    });
});

function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
}

document.addEventListener('DOMContentLoaded', function() {
    var postList = document.getElementById('post-list');
    if (postList) {
        postList.addEventListener('change', function() {
            var postId = this.value;
            if (postId !== '') {
                window.location.href = '/comment/index?id=' + postId;
            }
        });
    }
});
