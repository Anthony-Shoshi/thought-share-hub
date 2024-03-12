<?php

namespace App\Controllers\Api;

use App\Services\LikeService;
use App\Models\Like;

class LikeController extends ApiBaseController
{
    private $likeService;

    public function __construct()
    {
        $this->likeService = new LikeService();
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = json_decode(file_get_contents('php://input'), true);

            if (isset($postData['post_id'], $postData['ip']) && is_numeric($postData['post_id'])) {
                $postId = (int)$postData['post_id'];

                $postId = filter_var($postId, FILTER_SANITIZE_NUMBER_INT);
                $ip = filter_var($postData['ip'], FILTER_VALIDATE_IP);

                if ($postId !== false && $ip !== false) {                
                    $like = new Like();
                    $like->post_id = $postId;
                    $like->user_ip = $ip;

                    $success = $this->likeService->createLike($like);

                    $this->respondSuccess(['success' => $success]);
                } else {
                    $this->respondError('Invalid request body');
                }
            }
        }

        $this->respondError('Invalid request');
    }
}
