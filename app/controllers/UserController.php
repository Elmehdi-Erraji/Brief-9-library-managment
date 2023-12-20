<?php

namespace App\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\User;
use App\Methods\UserDAO;
use App\database\db_conn;

class UserController {
    public function createUser($postData) {
        // Retrieve form data
        $fullname = $_POST['first-name'] ?? '';
        $lastname = $_POST['last-name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        // $confirmPassword = $_POST['confirmPassword'] ?? '';
        $userRole = $_POST['user_role'] ?? '';
     

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





    public function addUser($postData) {
        $fullname = $postData['first-name'] ?? '';
        $lastname = $postData['last-name'] ?? '';
        $email = $postData['email'] ?? '';
        $phone = $postData['phone'] ?? '';
        $password = $postData['password'] ?? '';
        $role = $postData['user_role'] ?? ''; // Assuming 'user_role' corresponds to the role ID

        $user = new User($fullname, $lastname, $email, $phone, $password);
        $user->setRole($role); // Set user role
        $userDAO = new UserDAO();

        $result = $userDAO->addUser($user);

        return $result;
    }

  
}







if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {

    $userController = new UserController();
    $result = $userController->createUser($_POST);

    if ($result) {
        header('Location: /Brief-9-library-managment/views/auth/login.php');
        exit();
    } else {
        echo "Something went wrong.";
        exit();
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





















if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
        
        // Load required UserDAO file

        // Instantiate UserDAO to perform the deletion
        $userDAO = new UserDAO();
        
        // Call the deleteUserById method in UserDAO
        $deleted = $userDAO->deleteUserById($userId);

        // Redirect back to user list
        if ($deleted) {
            header('Location: /Brief-9-library-managment/views/admin/user-list.php');
            exit();
        } else {
            // Handle deletion failure
            echo "Failed to delete the user.";
        }
    } else {
        echo "User ID is missing.";
    }
}




















if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addUser'])) {
    // Instantiate the UserController
    $userController = new UserController();

    // Call the addUser method in UserController
    $result = $userController->addUser($_POST);

    if ($result) {
        // User added successfully
        // Redirect to user list or wherever appropriate
        header("Location: /Brief-9-library-managment/views/admin/user-list.php");
        exit();
    } else {
        // Failed to add user
        // Handle error
        echo "Failed to add user.";
    }
}









if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUser'])) {
    // Retrieve form data
    $userId = $_POST['user_id'] ?? '';
    $fullname = $_POST['first-name'] ?? '';
    $lastname = $_POST['last-name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $role = $_POST['user_role'] ?? '';

    // Perform validation as needed

    // Create an instance of UserDAO
    $userDAO = new UserDAO();

    // Get the user object by ID to check if it exists
    $existingUser = $userDAO->getUserById($userId);

    if ($existingUser) {
        // Update the user object with the new data
        $existingUser->setFullname($fullname);
        $existingUser->setLastname($lastname);
        $existingUser->setEmail($email);
        $existingUser->setPhone($phone);
        $existingUser->setRole($role);

        // Update the user in the database
        $result = $userDAO->updateUser($existingUser);

        if ($result) {
            // User updated successfully
            header('Location: /Brief-9-library-managment/views/admin/user-list.php');
            exit();
        } else {
            echo "Failed to update user.";
        }
    } else {
        echo "User not found.";
    }
}
?>