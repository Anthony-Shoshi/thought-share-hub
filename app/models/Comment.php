<?php

namespace App\Models;

class Comment
{
    public int $comment_id;
    public int $post_id;
    public string $name;
    public string $email;
    public string $comment_text;
    public string $created_at;

    public function __construct() {
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function validate(): array
    {
        $errors = [];
        if (empty($this->name)) {
            $errors['name'] = 'Name is required';
        }
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Valid email is required';
        }
        if (empty($this->comment_text)) {
            $errors['comment_text'] = 'Comment is required';
        }

        return $errors;
    }
}
