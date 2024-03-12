<?php

namespace App\Repositories;

use App\Config\DBconfig;
use App\Models\Post;
use PDO;

class PostRepository
{

    private $dbconfig;
    private $db;

    public function __construct()
    {
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

    public function getBySlug(string $slug): ?Post
    {
        $stmt = $this->db->prepare('
        SELECT 
            p.*, 
            u.username AS author,
            COUNT(l.like_id) AS total_likes
        FROM 
            posts p
        JOIN 
            users u ON p.user_id = u.user_id
        LEFT JOIN 
            likes l ON p.post_id = l.post_id
        WHERE 
            p.slug = :slug
        GROUP BY 
            p.post_id
    ');

        $stmt->execute([':slug' => $slug]);
        $result = $stmt->fetchObject(Post::class);

        return $result ?: null;
    }
    
    public function getById(int $postId): ?Post
    {
        $stmt = $this->db->prepare('
        SELECT 
            p.*, 
            u.username AS author,
            COUNT(l.like_id) AS total_likes
        FROM 
            posts p
        JOIN 
            users u ON p.user_id = u.user_id
        LEFT JOIN 
            likes l ON p.post_id = l.post_id
        WHERE 
            p.post_id = :post_id
        GROUP BY 
            p.post_id
    ');

        $stmt->execute([':post_id' => $postId]);
        $result = $stmt->fetchObject(Post::class);

        return $result ?: null;
    }


    public function getAll(string $whereClause = ''): array
    {
        $sql = '
        SELECT posts.*, users.username AS author, COUNT(likes.post_id) as total_like
        FROM posts
        JOIN users ON posts.user_id = users.user_id
        LEFT JOIN likes ON posts.post_id = likes.post_id
    ';

        if (!empty($whereClause)) {
            $sql .= ' WHERE ' . $whereClause;
        }

        $sql .= ' GROUP BY posts.post_id';

        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, Post::class);
        return $results;
    }

    public function getAllPostsLimitApi(): array
    {
        $stmt = $this->db->query('
            SELECT posts.*, users.username AS author
            FROM posts
            JOIN users ON posts.user_id = users.user_id
            WHERE is_featured = 0
        ');

        $results = $stmt->fetchAll(PDO::FETCH_CLASS, Post::class);
        return $results;
    }

    public function getAllFeaturedPosts(): array
    {
        $stmt = $this->db->query('
        SELECT posts.*, users.username AS author
        FROM posts
        JOIN users ON posts.user_id = users.user_id
        WHERE is_featured = 1
        ORDER BY RAND()
        LIMIT 2
    ');

        $results = $stmt->fetchAll(PDO::FETCH_CLASS, Post::class);
        return $results;
    }

    public function getAllPostsByCategoryId(int $categoryId): array
    {
        $stmt = $this->db->prepare('
        SELECT posts.*, users.username AS author
        FROM posts
        JOIN users ON posts.user_id = users.user_id
        WHERE posts.category_id = :category_id
    ');

        $stmt->execute([':category_id' => $categoryId]);

        $results = $stmt->fetchAll(PDO::FETCH_CLASS, Post::class);
        return $results;
    }

    public function create(Post $post): bool
    {
        $stmt = $this->db->prepare("INSERT INTO posts (user_id, category_id, title, content,short_description, image_url, is_featured, slug, created_at, updated_at) 
            VALUES (:user_id, :category_id, :title, :content, :short_description, :image_url, :is_featured, :slug, :created_at, :updated_at)");

        return $stmt->execute([
            ':user_id' => $post->user_id,
            ':category_id' => $post->category_id,
            ':title' => $post->title,
            ':content' => $post->content,
            ':short_description' => $post->short_description,
            ':image_url' => $post->image_url,
            ':is_featured' => $post->is_featured,
            ':slug' => $post->slug,
            ':created_at' => $post->created_at,
            ':updated_at' => $post->updated_at,
        ]);
    }

    public function getRelatedPosts($categoryId, $postId, $limit = 3): array
    {
        $stmt = $this->db->prepare('
        SELECT 
            p.*, 
            u.username AS author,
            COUNT(l.like_id) AS total_likes
        FROM 
            posts p
        JOIN 
            users u ON p.user_id = u.user_id
        LEFT JOIN 
            likes l ON p.post_id = l.post_id
        WHERE 
            p.category_id = :category_id AND
            p.post_id <> :post_id
        GROUP BY 
            p.post_id
        ORDER BY
            p.created_at DESC
        LIMIT :limit
    ');

        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_CLASS, Post::class);
        return $results;
    }

    public function getTotalPostsCount(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM posts');
        return $stmt->fetchColumn();
    }

    public function update(Post $post): bool
    {
        $query = "UPDATE posts SET user_id = :user_id, category_id = :category_id, title = :title, content = :content, short_description = :short_description, is_featured = :is_featured, slug = :slug, updated_at = :updated_at";

        $params = [
            ':post_id' => $post->post_id,
            ':user_id' => $post->user_id,
            ':category_id' => $post->category_id,
            ':title' => $post->title,
            ':content' => $post->content,
            ':short_description' => $post->short_description,
            ':is_featured' => $post->is_featured,
            ':slug' => $post->slug,
            ':updated_at' => $post->updated_at,
        ];

        if (!empty($post->image_url)) {
            $query .= ", image_url = :image_url";
            $params[':image_url'] = $post->image_url;
        }

        $query .= " WHERE post_id = :post_id";

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete(int $postId): bool
    {
        $stmt = $this->db->prepare('DELETE FROM posts WHERE post_id = :post_id');
        return $stmt->execute([':post_id' => $postId]);
    }
}
