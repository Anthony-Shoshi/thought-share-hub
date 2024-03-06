<?php

namespace App\Models;

class Post {
    public int $post_id;
    public int $user_id;
    public int $category_id;
    public string $title;
    public string $short_description;
    public string $author;
    public string $total_likes;
    public string $content;
    public string $image_url;
    public string $is_featured;
    public int $total_like;
    public string $created_at;
    public string $updated_at;
    public string $slug;

    public function __construct() {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }
}