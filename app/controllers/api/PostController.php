<?php

namespace App\Controllers\Api;

use App\Services\CategoryService;
use App\Services\PostService;

class PostController extends ApiBaseController
{
    private $postService;
    private $categoryService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->categoryService = new CategoryService();
    }

    public function getSearchPostsApi(): void
    {
        $keyword = $_GET['keyword'];
        $whereClause = "title LIKE '%$keyword%' OR content LIKE '%$keyword%' OR short_description LIKE '%$keyword%'";
        $posts = $this->postService->getAllPosts($whereClause);
        $this->respondSuccess($posts);
    }
    
    public function getAllPostsApi(): void
    {
        $posts = $this->postService->getAllPosts();
        $this->respondSuccess($posts);
    }

    public function getAllPostsLimitApi(): void
    {
        $posts = $this->postService->getAllPostsLimitApi();
        $this->respondSuccess($posts);
    }

    public function getAllFeaturedPostsApi(): void
    {
        $posts = $this->postService->getAllFeaturedPosts();
        $this->respondSuccess($posts);
    }

    public function getAllPostsByCategory()
    {
        $slug = $_GET['cat'];
        $id = $this->categoryService->getCategoryBySlug($slug)->category_id;
        $posts = $this->postService->getAllPostsByCategoryId($id);
        $this->respondSuccess($posts);
    }
}
