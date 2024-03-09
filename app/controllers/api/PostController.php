<?php

namespace App\Controllers\Api;

use App\Services\CategoryService;
use App\Services\PostService;

class PostController extends ApiBaseController
{
    private $postService;

    public function __construct()
    {
        $this->postService = new PostService();
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

    public function getAllPostsByCategoryId()
    {
        $id = $_GET['catid'];
        $posts = $this->postService->getAllPostsByCategoryId($id);
        $this->respondSuccess($posts);
    }
}
