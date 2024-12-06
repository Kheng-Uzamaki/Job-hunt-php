<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class UserController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show the login page 
     * @return void
     */
    public function login()
    {
        loadView('users/login');
    }


    /**
     * Show the register page 
     * @return void
     */
    public function create()
    {
        loadView('users/create');
    }

    /**
     * Store user in database
     * @return void
     */
    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['password_confirmation'];

        $errors = [];

        //validation
        if (!Validation::email($email)) {
            $errors['email'] = 'Pleae enter a valid email!';
        }

        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = 'Name must be between 2 and 50 characters!';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['name'] = 'Password must be at least 6 charaters!';
        }

        if (!Validation::match($password,$passwordConfirmation)) {
            $errors['name'] = 'Password do not match!';
        }

        if (!empty($errors)) {
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state,
                ]
            ]);
            exit;
        } else {
        }
    }
}
