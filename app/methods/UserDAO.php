<?php

namespace App\Methods;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\User;
use App\Database\db_conn;


class UserDAO {
    private $db;

    public function __construct() {
        $this->db = db_conn::getConnection(); // Get the database connection
    }

    public function createUser(User $user) {
        $fullname = $user->getFullName();
        $lastname = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $phone = $user->getPhone();
        $budget = $user->getBudget();
    
        $query = "INSERT INTO users (fullname, lastname, email, password, phone, budget) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
    
        mysqli_stmt_bind_param($stmt, "sssssd", $fullname, $lastname, $email, $password, $phone, $budget);
        $success = mysqli_stmt_execute($stmt);
    
        if ($success) {
            // User created successfully
            $userId = mysqli_insert_id($this->db); // Get the ID of the newly inserted user
    
            // Assign 'User' role to the user by default
            $roleId = 2; // Assuming 'User' role has ID 2, adjust as per your roles table
    
            $queryRolesUsers = "INSERT INTO roles_users (roles_id, users_id) VALUES (?, ?)";
            $stmtRolesUsers = mysqli_prepare($this->db, $queryRolesUsers);
            mysqli_stmt_bind_param($stmtRolesUsers, "ii", $roleId, $userId);
            $successRolesUsers = mysqli_stmt_execute($stmtRolesUsers);
    
            if ($successRolesUsers) {
                return true; // User created and assigned role successfully
            } else {
                // Rollback user creation as role assignment failed
                $deleteUserQuery = "DELETE FROM users WHERE id = ?";
                $stmtDeleteUser = mysqli_prepare($this->db, $deleteUserQuery);
                mysqli_stmt_bind_param($stmtDeleteUser, "i", $userId);
                mysqli_stmt_execute($stmtDeleteUser);
    
                return false; // Role assignment failed
            }
        } else {
            return false; // User creation failed
        }
    }
}
