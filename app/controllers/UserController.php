<?php

namespace App\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\User;
use App\Methods\UserDAO;
use App\database\db_conn;

class UserController {
    public function createUser($postData) {
        // Retrieve form data
        $fullname = $postData['username'];
        $lastname = $postData['last-name'];
        $email = $postData['email'];
        $phone = $postData['phone'];
        $password = $postData['password'];
        // $confirmPassword = $postData['confirm_password'];
     

        // add form validation here 

        // Create a Users object
        $user = new User($fullname, $lastname, $email, $phone,$password);

        // Create an instance of UserMethods
        $userMethods = new UserDAO();

        // Call the createUser method in UserMethods to handle SQL logic
        $result = $userMethods->createUser($user);

        if ($result) {
            // User created successfully
            return true;
        } else {
            // User creation failed
            return false;
        }
    }

   
    public function loginUser($email, $password) {
        // Instantiate UserDAO
        $userDAO = new UserDAO();

        // Get user details by email
        $user = $userDAO->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Start a session
            session_start();

            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];

            // Get user's role
            $role = $userDAO->getUserRole($user['id']);

            // Redirect based on user's role
            if ($role === 1) {
                header('Location: /Brief-9-library-managment/views/admin/dashboard.php');
                exit();
            } elseif ($role === 2) {
                header('Location: /Brief-9-library-managment/views/user/dashboard.php');
                exit();
            } else {
                header('Location: unknown_role.php');
                exit();
            }
        } else {
            // Redirect with error message for invalid credentials
            header('Location: login.php?error=invalid_credentials');
            exit();
        }
    }

    public function getUsers() {
        $users = UserDAO::getAllUsers();
        return $users;
    }
}









if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Instantiate the UserController
    $userController = new UserController();

    // Call the loginUser method in UserController
    $userController->loginUser($email, $password);
}

































// Simple routing logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    // Instantiate the UserController
    $userController = new UserController();

    // Call the createUser method in UserController
    $result = $userController->createUser($_POST);

    if ($result) {
        // User created successfully
        header('Location: /Brief-9-library-managment/views/auth/login.php');
        exit();
    } else {
        echo "something went wrong buddy";
        // // User creation failed
        // header('Location: signup.php?error=failed_creation');
        exit();
    }
}