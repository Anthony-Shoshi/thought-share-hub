<?php

namespace App\Controllers\Api;

use App\Models\Comment;
use App\Services\CommentService;
use App\Services\PostService;

class CommentController extends ApiBaseController
{
    private $commentService;
    private $postService;

    public function __construct() {
        $this->commentService = new CommentService();
        $this->postService = new PostService();
    }

    public function store(): void
    {
        $comment = new Comment();

        $comment->post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
        $comment->name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8') : '';
        $comment->email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8') : '';
        $comment->comment_text = isset($_POST['comment_text']) ? htmlspecialchars(trim($_POST['comment_text']), ENT_QUOTES, 'UTF-8') : '';    

        $result = $this->commentService->createComment($comment);

        if ($result['success']) {
            $this->respondSuccess(['success' => true, 'message' => 'Comment stored successfully']);
        } else {
            $this->respondSuccess(['success' => false, 'errors' => $result['errors']]);
        }
    }
    
    public function getAllCommentsByPostId(): void
    {
        $slug = $_GET['slug'];
        $postId = $this->postService->getPostBySlug($slug)->post_id;
        $comments = $this->commentService->getCommentsByPostId($postId);
        $this->respondSuccess($comments);
    }
}
