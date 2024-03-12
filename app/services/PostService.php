<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Models\Post;

class PostService
{

    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function getPostBySlug(string $slug): ?Post
    {
        return $this->postRepository->getBySlug($slug);
    }
    
    public function getPostById(int $postId): ?Post
    {
        return $this->postRepository->getById($postId);
    }

    public function getAllPosts(string $whereClause = ''): array
    {
        return $this->postRepository->getAll($whereClause);
    }

    public function getAllPostsLimitApi(): array
    {
        return $this->postRepository->getAllPostsLimitApi();
    }

    public function getAllFeaturedPosts(): array
    {
        return $this->postRepository->getAllFeaturedPosts();
    }

    public function getAllPostsByCategoryId(int $categoryId): array
    {
        return $this->postRepository->getAllPostsByCategoryId($categoryId);
    }

    public function createPost(Post $post): bool
    {
        return $this->postRepository->create($post);
    }

    public function getRelatedPosts(int $categoryId, int $postId, int $limit = 3): array
    {
        return $this->postRepository->getRelatedPosts($categoryId, $postId, $limit);
    }

    public function getTotalPostsCount(): int
    {
        return $this->postRepository->getTotalPostsCount();
    }

    public function updatePost(Post $post): bool
    {
        return $this->postRepository->update($post);
    }

    public function deletePost(int $postId): bool
    {
        return $this->postRepository->delete($postId);
    }
}
