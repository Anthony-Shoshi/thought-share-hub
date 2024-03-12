<?php

namespace App\Controllers;

use App\Services\UserService;
use App\Models\User;

class UserController
{

    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function getUserById(int $userId): ?User
    {
        return $this->userService->getUserById($userId);
    }

    public function getUserByUsername(string $username): ?User
    {
        return $this->userService->getUserByUsername($username);
    }

    public function createUser(User $user): bool
    {
        return $this->userService->createUser($user);
    }

    public function login(?string $username = null, ?string $password = null)
    {
        $baseDir = __DIR__ . "/../";

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['user'])) {
            header("Location: /home/backend");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include $baseDir . 'views/frontend/auth/login.php';
            exit;
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim(filter_input(INPUT_POST, 'username', FILTER_DEFAULT, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH)), ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars(trim(filter_input(INPUT_POST, 'password', FILTER_DEFAULT, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH)), ENT_QUOTES, 'UTF-8');

            $user = $this->userService->validateLogin($username, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user->user_id,
                    'username' => $user->username,
                ];
                header("Location: /home/backend");
                exit;
            } else {
                $_SESSION['alert'] = [
                    'type' => 'danger',
                    'message' => 'Invalid username or password.',
                ];
                include $baseDir . 'views/frontend/auth/login.php';
                exit;
            }
        } else {
            echo "Method not allowed.";
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);

        header("Location: /");
        exit;
    }
}
