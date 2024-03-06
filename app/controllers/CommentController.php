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

    public function store(): void
    {
        $comment = new Comment();

        $comment->post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
        $comment->name = $_POST['name'] ?? '';
        $comment->email = $_POST['email'] ?? '';
        $comment->comment_text = $_POST['comment_text'] ?? '';

        $result = $this->commentService->createComment($comment);

        header('Content-Type: application/json');

        if ($result['success']) {
            echo json_encode(['success' => true, 'message' => 'Comment stored successfully']);
        } else {
            echo json_encode(['success' => false, 'errors' => $result['errors']]);
        }

        exit;
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
