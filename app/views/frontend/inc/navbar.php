<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">

            <img src="/images/logo.png" alt="Logo" width="50" height="40" class="d-inline-block align-text-top me-2">

            Thought Share Hub
        </a>

        <div class="mx-auto">
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle col-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="navbarDropdownMenu">
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link col-white" href="/home/blogs">All Blogs</a>
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

<script src="/assets/frontend/js/navbar.js"></script>