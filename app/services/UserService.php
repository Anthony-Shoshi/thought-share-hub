<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

class UserService {

    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function getUserById(int $userId): ?User {
        return $this->userRepository->getById($userId);
    }

    public function getUserByUsername(string $username): ?User {
        return $this->userRepository->getByUsername($username);
    }

    public function createUser(User $user): bool {
        return $this->userRepository->create($user);
    }

    public function validateLogin(string $username, string $password): ?User {
        $user = $this->getUserByUsername($username);
        
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return null;
    }

}
