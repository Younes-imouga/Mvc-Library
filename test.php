<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Models\User;

$user = new User();
$user->username = 'hellotest';
$user->email = 'lkjh@gmail.com';
$user->role = 'client';
$user->password = '123';
$user->save();