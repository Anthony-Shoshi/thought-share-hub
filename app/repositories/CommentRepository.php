<?php

namespace App\Repositories;

use App\Config\DBconfig;
use App\Models\Comment;
use PDO;

class CommentRepository {

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
        $stmt = $this->db->prepare('SELECT * FROM comments WHERE post_id = :post_id LIMIT 5');
        $stmt->execute([':post_id' => $postId]);
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, Comment::class);
        return $results;
    }

    public function create(Comment $comment): bool {
        $stmt = $this->db->prepare("INSERT INTO comments (post_id, name, email, comment_text, created_at) 
            VALUES (:post_id, :name, :email, :comment_text, :created_at)");

        return $stmt->execute([
            ':post_id' => $comment->post_id,
            ':name' => $comment->name,
            ':email' => $comment->email,
            ':comment_text' => $comment->comment_text,
            ':created_at' => $comment->created_at,
        ]);
    }

    public function delete(int $commentId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE comment_id = :comment_id");

        return $stmt->execute([':comment_id' => $commentId]);
    }
}
