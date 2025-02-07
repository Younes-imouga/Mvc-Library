<?php

namespace App\Core;

class Validator {
    public static function validateUserInput($data) {
        $errors = [];

        if (empty($data['username'])) {
            $errors['username'] = 'Username is required';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Valid email is required';
        }

        if (empty($data['password']) || strlen($data['password']) < 4) {
            $errors['password'] = 'Password must be at least 4 characters';
        }

        return empty($errors) ? true : $errors;
    }
}
