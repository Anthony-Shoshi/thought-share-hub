<?php

namespace App\Controllers\Api;

use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends ApiBaseController
{
    private $commentService;

    public function __construct() {
        $this->commentService = new CommentService();
    }

    public function store(): void
    {
        $comment = new Comment();

        $comment->post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
        $comment->name = $_POST['name'] ?? '';
        $comment->email = $_POST['email'] ?? '';
        $comment->comment_text = $_POST['comment_text'] ?? '';

        $result = $this->commentService->createComment($comment);

        if ($result['success']) {
            $this->respondSuccess(['success' => true, 'message' => 'Comment stored successfully']);
        } else {
            $this->respondSuccess(['success' => false, 'errors' => $result['errors']]);
        }
    }
    
    public function getAllCommentsByPostId(): void
    {
        $postId = $_GET['id'];
        $comments = $this->commentService->getCommentsByPostId($postId);
        $this->respondSuccess($comments);
    }
}
