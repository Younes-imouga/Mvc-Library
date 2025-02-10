<?php
namespace App\Controllers\front;

use App\Models\User;
use App\Core\Security;
use App\Core\Session;
use App\Core\Validator;
use App\Core\View;

class authcontroller extends View{
    function renderSignUp($data = []) {
        View::render('signup', $data);
    }
    
    function renderLogin($data = []) {
        View::render('login', $data);
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => $_POST['username'] ?? '',
                'email'    => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? ''
            ];
    
            $validationResult = Validator::validateUserInput($data);
            if ($validationResult !== true) {
                return $this->renderSignUp(['errors' => $validationResult]);
            }
    
            $data = Security::sanitizeInput($data);
            $data['password'] = Security::hashPassword($data['password']);
    
            $isFirstUser = User::count() === 0;
    
            $data['role'] = $isFirstUser ? 'admin' : 'client';
    
            if (User::where('email', $data['email'])->exists()) {
                return $this->renderSignUp(['errors' => ['email' => 'User with this email already exists.']]);
            }
    
            $user = User::create($data);

            Session::start();
            Session::set('user_id', $user->id);
            Session::set('user_email', $user->email);
            Session::set('logged_in', true);
            $role = $user->getUserRole($user->email);

            if ($role === 'admin') {
                Session::set('is_admin', true);
                
            } else {
                header('Location: /home');
            }
            exit();
        }
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            $user = User::where('email', $email)->first();
    
            if ($user && password_verify($password, $user->password)) {
                Session::start();
                Session::set('user_id', $user->id);
                Session::set('user_email', $user->email);
                Session::set('logged_in', true);
                $role = $user->getUserRole($user->email);

                if ($role === 'admin') {
                    Session::set('is_admin', true);
                    header('Location: /home');
                } else {
                    header('Location: /home');
                }
                exit();
            } else {
                return $this->renderLogin(['errors' => ['login' => 'Invalid email or password.']]);
            }
        }
    }

    public function logout() {
        Session::start();
        Session::destroy();
        header('Location: /login');
        exit();
    }

}