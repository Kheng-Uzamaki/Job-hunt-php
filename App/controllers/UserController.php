<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

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
            $errors['email'] = 'Please enter a valid email!';
        }

        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = 'Name must be between 2 and 50 characters!';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['name'] = 'Password must be at least 6 charaters!';
        }

        if (!Validation::match($password, $passwordConfirmation)) {
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
        }

        // check if email is existing
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT email FROM users WHERE email = :email', $params)->fetch();

        if ($user) {
            $errors['email'] = 'Email already exists!';
            loadView('users/create', [
                'errors' => $errors,
            ]);
            exit;
        }

        // Create new user
        $params = [
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            // Hash password
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->query('INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)', $params);

        // Get user Id
        $userId = $this->db->conn->lastInsertId();

        // Store user id in session
        Session::set('user', [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
        ]);



        redirect('/');
    }

    /**
     * Logout a user and kill session
     * 
     * @return void
     * 
     */
    public function logout()
    {
        Session::clearAll();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }

    /**
     * Authenicate a user by email and password
     * @return void
     */
    public function authenticate(){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

        //Validation
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email!';
        }
        
        if (!Validation::string($password, 6, 50)) {
            $errors['name'] = 'Password must be at least 6 characters!';
        }
        
        // Check for error
        if (!empty($errors)) {
            loadView('users/login', [
                'errors' => $errors,
            ]);
            exit;
        }

        // Check user by email
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        // If user not found
        if (!$user) {
            $errors['email'] = 'Email or password is incorrect!';
            loadView('users/login', [
                'errors' => $errors,
            ]);
            exit;
        }

        // Check password
        if (!password_verify($password, $user->password)) {
            $errors['email'] = 'Email or password is incorrect!';
            loadView('users/login', [
                'errors' => $errors,
            ]);
            exit;
        }

        // Store user id in session
        Session::set('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'city' => $user->city,
            'state' => $user->state,
        ]);

        redirect('/');
    }
}
