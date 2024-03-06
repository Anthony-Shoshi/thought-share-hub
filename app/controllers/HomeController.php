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
        include "../views/home/index.php";
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
        include "../views/blogs.php";
        exit;
    }

    public function blog()
    {
        $id = $_GET['id'];
        $details = $this->postService->getPostById($id);
        $relatedPosts = $this->postService->getRelatedPosts($details->category_id, $details->post_id);
        $comments = $this->commentsService->getCommentsByPostId($details->post_id);
        $currentUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        include "../views/post-details.php";
        exit;
    }

    function category(): void
    {
        $id = $_GET['catid'];
        include "../views/category-blogs.php";
        exit;
    }
}
