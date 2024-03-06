<?php

namespace App\Repositories;

use App\Config\DBconfig;
use App\Models\Category;
use PDO;

class CategoryRepository {

    private $dbconfig;
    private $db;

    public function __construct() {
        // $this->dbconfig = new DBconfig();

        // $config = $this->dbconfig->getConfig();

        // $type = $config['type'];
        // $servername = $config['servername'];
        // $dbname = $config['database'];
        // $username = $config['username'];
        // $password = $config['password'];

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

    public function getById(int $categoryId): ?Category {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE category_id = :category_id');
        $stmt->execute([':category_id' => $categoryId]);
        $result = $stmt->fetchObject(Category::class);
        return $result ?: null;
    }

    public function getAll(): array {
        $stmt = $this->db->query('SELECT * FROM categories');
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, Category::class);
        return $results;
    }

    public function create(Category $category): bool {
        $stmt = $this->db->prepare("INSERT INTO categories (category_name, slug) 
            VALUES (:category_name, :slug)");

        return $stmt->execute([
            ':category_name' => $category->category_name,
            ':slug' => $category->slug,
        ]);
    }

    public function update(Category $category): bool
    {
        $stmt = $this->db->prepare("UPDATE categories SET category_name = :category_name, slug = :slug WHERE category_id = :category_id");

        return $stmt->execute([
            ':category_id' => $category->category_id,
            ':category_name' => $category->category_name,
            ':slug' => $category->slug
        ]);
    }

    public function delete(int $categoryId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE category_id = :category_id");

        return $stmt->execute([':category_id' => $categoryId]);
    }

    public function getTotalCategoryCount(): int {
        $stmt = $this->db->query('SELECT COUNT(*) FROM categories');
        return $stmt->fetchColumn();
    }
}
