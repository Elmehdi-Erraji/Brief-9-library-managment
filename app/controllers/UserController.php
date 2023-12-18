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
     

        // Basic form validation...
        // ...

        // Create a Users object
        $user = new User($fullname, $lastname, $email, $phone,$password);

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

    // public function loginUser($email, $password) {
    //     // Instantiate the UserDAO
    //     $userDAO = new UserDAO();

    //     // Get user details by email
    //     $user = $userDAO->getUserByEmail($email);

    //     var_dump($user);

    //     if (password_verify($password, $user->getPassword())) {

    //         echo "waaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";

    //         // Password is correct
    //         // Start a session
    //         session_start();

    //         // Store user data in session
    //         $_SESSION['user_id'] = $user->getId();
    //         $_SESSION['fullname'] = $user->getFullName();
    //         $_SESSION['email'] = $user->getEmail();
    //         $_SESSION['role'] = $userDAO->getUserRole($user->getId());

    //         // Redirect to the user's dashboard or desired page
    //         header('Location: dashboard.php');
    //         exit();
    //     } else {
    //         echo "didn't work";
    //         exit();
    //     }
    // }
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
                header('Location: /Brief-9-library-managment/views/dashboard.php');
                exit();
            } elseif ($role === 2) {
                header('Location: /Brief-9-library-managment/views/userDashboard.php');
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
}









if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Instantiate the UserController
    $userController = new UserController();

    // Call the loginUser method in UserController
    $userController->loginUser($email, $password);
}


































// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $connection = db_conn::getConnection();

//     // Check if the connection was successful
//     if (!$connection) {
//         die("Database connection error."); // Handle the connection error as needed
//     }

//     $sql = "SELECT * FROM users WHERE email = ?";
//     $stmt = mysqli_prepare($connection, $sql);
//     mysqli_stmt_bind_param($stmt, "s", $email);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);
//     $user = mysqli_fetch_assoc($result);

//     if ($user) {
//         // User found, verify password
//         if (password_verify($password, $user['password'])) {
//             $_SESSION['user_id'] = $user['id'];
//             $_SESSION['fullname'] = $user['fullname'];
//             $_SESSION['email'] = $user['email'];
            
//             $userDAO = new UserDAO();
            
//             // Fetch user role using the method
//             $role = $userDAO->getUserRole($user['id']); 
//             if ($role === 1) {
//                 header('Location: /Brief-9-library-managment/views/dashboard.php');
//                 exit();
//             } elseif ($role === 2) {
//                 header('Location: /Brief-9-library-managment/views/userDashboard.php');
//                 exit();
//             } else {
//                 header('Location: unknown_role.php');
//                 exit();
//             }
//         } else {
//             header('Location: login.php?error=invalid_password');
//             exit();
//         }
//     } else {
//         header('Location: login.php?error=user_not_found');
//         exit();
//     }
// }

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