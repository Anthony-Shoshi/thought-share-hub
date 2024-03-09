<?php

namespace App\Controllers;

use App\Services\CommentService;
use App\Models\Comment;
use App\Services\PostService;

class CommentController
{

    private $commentService;
    private $postService;

    public function __construct()
    {
        $this->commentService = new CommentService();
        $this->postService = new PostService();
    }

    function index(): void
    {
        $posts = $this->postService->getAllPosts();
        $postTitle = "";
        $comments = [];
        if (isset($_GET['id'])) {
            $postId = $_GET['id'];
            $postTitle = "- " . $this->postService->getPostById($postId)->title;
            $comments = $this->commentService->getCommentsByPostId($postId);
        }
        include '../views/backend/comments/index.php';
        exit;
    }

    public function getCommentsByPostId(int $postId): array
    {
        return $this->commentService->getCommentsByPostId($postId);
    }

    public function delete(): void
    {
        $commentId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $success = $this->commentService->deleteComment($commentId);

        if ($success) {
            $_SESSION['success'] = true;
            $_SESSION['message'] = 'Comment deleted successfully!';
        } else {
            $_SESSION['success'] = false;
            $_SESSION['message'] = 'Failed to delete Comment.';
        }

        header('location: /comment/index');
    }
}
