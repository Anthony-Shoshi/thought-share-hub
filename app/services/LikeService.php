<?php

namespace App\Services;

use App\Repositories\LikeRepository;
use App\Models\Like;

class LikeService {

    private $likeRepository;

    public function __construct() {
        $this->likeRepository = new LikeRepository();
    }

    public function getLikesByPostId(int $postId): array {
        return $this->likeRepository->getByPostId($postId);
    }

    public function createLike(Like $like): bool {
        return $this->likeRepository->create($like);
    }

}
