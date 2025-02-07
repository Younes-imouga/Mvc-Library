<?php

namespace App\Models;

use App\Core\BaseModel;

class User extends BaseModel
{
    public function insertUser($username, $password, $email, $role){
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        $this->password = $password;
        $this->save();
    }

    public function VerifyEmail($email){
        $exists = User::where('email', $email)->exists();
        if ($exists) {
            return true;
        } else {
            return false;
        }
    }

    public function VerifyUsername($user){
        $exists = User::where('email', $user)->exists();
        if ($exists) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserRole($email){
        $user = User::where('email', $email)->first();
        if ($user) {
            return $user->role;
        }
        return null;
    }
}