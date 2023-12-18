<?php

namespace App\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\User;
use App\Methods\UserDAO;


class UserController {
    public function createUser($postData) {
        // Retrieve form data
        $fullname = $postData['username'];
        $lastname = $postData['last-name'];
        $email = $postData['email'];
        $phone = $postData['phone'];
        $password = $postData['password'];
        $confirmPassword = $postData['confirm_password'];
        $budget = 0.0; // You might set this based on user input

        // Basic form validation...
        // ...

        // Create a Users object
        $user = new User($fullname, $lastname, $email, $password, $phone, $budget);

        // Create an instance of UserMethods
        $userMethods = new UserDAO();

        // Call the createUser method in UserMethods to handle SQL logic
        $result = $userMethods->createUser($user);

        // Handle the result of user creation
        if ($result) {
            // User created successfully
            return true;
        } else {
            // User creation failed
            return false;
        }
    }
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