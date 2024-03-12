<?php

namespace App\Helpers;

class Helper
{
    public static function slug($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function debug($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit;
    }

    public static function validateAndSanitizeFields($fields)
    {
        $errors = [];

        foreach ($fields as $fieldName => $value) {
            $fieldName = str_replace('_', ' ', $fieldName);
            $fieldName = ucwords($fieldName);

            if (isset($value) && !empty($value)) {
                $fields[$fieldName] = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
            } else {
                $errors[$fieldName] = "$fieldName is required.";
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            return false;
        }

        return $fields;
    }
}
