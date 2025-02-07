<?php

namespace App\Core;

class Security {
    public static function sanitizeInput($data)
    {
        return array_map('htmlspecialchars', $data);
    }

    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
