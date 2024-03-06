<?php
namespace App\Models;

class User {
    public int $user_id;
    public string $username;
    public string $password;
    public string $email;
    public string $profile_picture;
    public string $registration_date;    
}
