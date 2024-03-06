<?php

namespace App\Models;

class Like {
    public int $like_id;
    public int $post_id;
    public string $user_ip;
    public string $created_at;

    public function __construct() {
        $this->created_at = date('Y-m-d H:i:s');
    }
    
}