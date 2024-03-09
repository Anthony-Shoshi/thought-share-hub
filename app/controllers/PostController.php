<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Services\PostService;
use App\Models\Post;
use App\Services\CategoryService;

class PostController
{

    private $postService;
    private $categoryService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->categoryService = new CategoryService();
    }

    public function getPostById(int $postId): ?Post
    {
        return $this->postService->getPostById($postId);
    }

    public function getAllPosts(): array
    {
        return $this->postService->getAllPosts();
    }

    public function createPost(Post $post): bool
    {
        return $this->postService->createPost($post);
    }

    function index(): void
    {
        $posts = $this->postService->getAllPosts();
        include '../views/backend/posts/index.php';
        exit;
    }

    public function create(?string $message = ''): void
    {
        $categories = $this->categoryService->getAllCategories();
        include '../views/backend/posts/create.php';
        exit;
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = new Post();
            $post->title = $_POST['title'];
            $post->user_id = $_SESSION['user']['id'];
            $post->category_id = $_POST['category_id'];
            $post->short_description = $_POST['short_description'];
            $post->content = $_POST['content'];
            $isFeatured = isset($_POST['is_featured']) ? $_POST['is_featured'] : 0;
            $post->is_featured = $isFeatured;
            $post->slug = Helper::slug($post->title);

            $uploadDirectory = 'public/images';

            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }

            $imagePath = $uploadDirectory . '/' . uniqid() . '_' . $_FILES['image_url']['name'];

            if (move_uploaded_file($_FILES['image_url']['tmp_name'], $imagePath)) {
                $post->image_url = '/' . $imagePath;

                $success = $this->postService->createPost($post);

                if ($success) {
                    $_SESSION['success'] = true;
                    $_SESSION['message'] = 'Post created successfully!';
                } else {
                    $_SESSION['success'] = false;
                    $_SESSION['message'] = 'Failed to create post.';
                }
            } else {
                $_SESSION['success'] = false;
                $_SESSION['message'] = 'Failed to upload image.';
            }

            header("Location: /post/create");
        }
    }


    public function edit(): void
    {
        $postId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $post = $this->getpostById($postId);
        $categories = $this->categoryService->getAllCategories();

        if (!$post) {
            $_SESSION['success'] = false;
            $_SESSION['message'] = 'post not found.';
        }

        include '../views/backend/posts/edit.php';
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = new Post();
            $post->post_id = $_POST['post_id'];
            $post->title = $_POST['title'];
            $post->user_id = $_SESSION['user']['id'];
            $post->category_id = $_POST['category_id'];
            $post->short_description = $_POST['short_description'];
            $post->content = $_POST['content'];
            $isFeatured = isset($_POST['is_featured']) ? $_POST['is_featured'] : 0;
            $post->is_featured = $isFeatured;
            $post->slug = Helper::slug($post->title);
            $post->updated_at = date('Y-m-d H:i:s');

            if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
                $success = $this->updatePostWithImage($post);
            } else {
                $success = $this->updatePostTitle($post);
            }

            if ($success) {
                $_SESSION['success'] = true;
                $_SESSION['message'] = 'Post updated successfully!';
                header("Location: /post/index");
                exit();
            } else {
                $_SESSION['success'] = false;
                $_SESSION['message'] = 'Failed to update post.';
            }
        }

        include '../views/backend/category/edit.php';
    }

    private function updatePostWithImage(Post $post): bool
    {
        $targetDir = 'public/images';
        $filename = uniqid() . '_' . basename($_FILES["image_url"]["name"]);
        $targetFilePath = $targetDir . '/' . $filename;

        if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $targetFilePath)) {
            $post->image_url = '/' . $targetFilePath;
            return $this->postService->updatePost($post);
        } else {
            return false;
        }
    }

    private function updatePostTitle(Post $post): bool
    {
        return $this->postService->updatePost($post);
    }

    public function delete(): void
    {
        $success = 0;
        $postId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($postId != 0) {            
            $post = $this->postService->getPostById($postId);
            if ($post->image_url != "") {
                $imageUrl = ltrim($post->image_url, '/');                
                unlink($imageUrl);
            }
            $success = $this->postService->deletePost($postId);
        }

        if ($success) {
            $_SESSION['success'] = true;
            $_SESSION['message'] = 'post deleted successfully!';
        } else {
            $_SESSION['success'] = false;
            $_SESSION['message'] = 'Failed to delete post.';
        }

        header("location: /post/index");
        // $posts = $this->postService->getAllPosts();
        // include '../views/backend/posts/index.php';
    }
}
