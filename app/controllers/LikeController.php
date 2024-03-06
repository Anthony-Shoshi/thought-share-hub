<?php

namespace App\Controllers;

use App\Services\LikeService;
use App\Models\Like;

class LikeController
{

    private $likeService;

    public function __construct()
    {
        $this->likeService = new LikeService();
    }

    public function getLikesByPostId(int $postId): array
    {
        return $this->likeService->getLikesByPostId($postId);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = json_decode(file_get_contents('php://input'), true);

            if (isset($postData['post_id'], $postData['ip'])) {
                $postId = (int)$postData['post_id'];
                $ip = filter_var($postData['ip'], FILTER_VALIDATE_IP);

                if ($postId !== false && $ip !== false) {
                    $like = new Like();
                    $like->post_id = $postId;
                    $like->user_ip = $ip;

                    $success = $this->likeService->createLike($like);

                    header('Content-Type: application/json');
                    echo json_encode(['success' => $success]);
                    exit;
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['error' => 'Invalid request']);
        exit;
    }
}
