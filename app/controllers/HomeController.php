<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\CommentService;
use App\Services\PostService;
use App\Services\UserService;

class HomeController
{
    private $userService;
    private $postService;
    private $commentsService;
    private $categoryService;

    function __construct()
    {
        $this->userService = new UserService();
        $this->postService = new PostService();
        $this->categoryService = new CategoryService();
        $this->commentsService = new CommentService();
    }

    public function index()
    {
        include "../views/frontend/home/index.php";
        exit;
    }

    public function backend()
    {
        $totalPosts = $this->postService->getTotalPostsCount();
        $totalCategories = $this->categoryService->getTotalCategoryCount();
        include "../views/backend/index.php";
        exit;
    }

    public function blogs()
    {        
        include "../views/frontend/blogs.php";
        exit;
    }

    public function blog()
    {
        $slug = $_GET['slug'];
        $details = $this->postService->getPostBySlug($slug);
        $relatedPosts = $this->postService->getRelatedPosts($details->category_id, $details->post_id);
        $currentUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        include "../views/frontend/post-details.php";
        exit;
    }

    function category(): void
    {
        $slug = $_GET['cat'];
        $categoryName = $this->categoryService->getCategoryBySlug($slug)->category_name;
        include "../views/frontend/category-blogs.php";
        exit;
    }
}
