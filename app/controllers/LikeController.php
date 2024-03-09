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
}
