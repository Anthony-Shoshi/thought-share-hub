<?php

namespace App\Repositories;

use App\Config\DBconfig;
use App\Models\Like;
use PDO;

class LikeRepository {

    private $dbconfig;
    private $db;

    public function __construct() {
        $config = include '../config/database.php';

        $type = $config['type'];
        $servername = $config['servername'];
        $dbname = $config['database'];
        $username = $config['username'];
        $password = $config['password'];

        $this->db = new PDO(
            "$type:host=$servername;dbname=$dbname",
            $username,
            $password
        );
    }

    public function getByPostId(int $postId): array {
        $stmt = $this->db->prepare('SELECT * FROM likes WHERE post_id = :post_id');
        $stmt->execute([':post_id' => $postId]);
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, Like::class);
        return $results;
    }

    public function create(Like $like): bool {
        $stmt = $this->db->prepare("INSERT INTO likes (post_id, user_ip, created_at) 
            VALUES (:post_id, :user_ip, :created_at)");

        return $stmt->execute([
            ':post_id' => $like->post_id,
            ':user_ip' => $like->user_ip,
            ':created_at' => $like->created_at,
        ]);
    }

}
