<?php

namespace App\Repositories;

use App\Config\DBconfig;
use App\Models\User;
use PDO;

class UserRepository {

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

    public function getById(int $userId): ?User {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $stmt->execute([':user_id' => $userId]);
        $result = $stmt->fetchObject(User::class);
        return $result ?: null;
    }

    public function getByUsername(string $username): ?User {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute([':username' => $username]);
        $result = $stmt->fetchObject(User::class);
        return $result ?: null;
    }

    public function create(User $user): bool {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email, profile_picture, registration_date) 
            VALUES (:username, :password, :email, :profile_picture, :registration_date)");

        return $stmt->execute([
            ':username' => $user->username,
            ':password' => $user->password,
            ':email' => $user->email,
            ':profile_picture' => $user->profile_picture,
            ':registration_date' => $user->registration_date,
        ]);
    }

}