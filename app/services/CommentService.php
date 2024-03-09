<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use App\Models\Comment;

class CommentService {

    private $commentRepository;

    public function __construct() {
        $this->commentRepository = new CommentRepository();
    }

    public function getCommentsByPostId(int $postId): array {
        return $this->commentRepository->getByPostId($postId);
    }

    public function createComment(Comment $comment): array {
        $validationErrors = $comment->validate();

        if (empty($validationErrors)) {
            $isStored = $this->commentRepository->create($comment);
            if ($isStored) {
                return ['success' => true, 'message' => 'Comment stored successfully'];
            } else {
                return ['success' => false, 'message' => 'Failed to store comment'];
            }
        } else {
            return ['success' => false, 'errors' => $validationErrors];
        }
    }

    public function deleteComment(int $commentId): bool {
        return $this->commentRepository->delete($commentId);
    }

}
