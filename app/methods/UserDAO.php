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
        $phone = $user->getPhone();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
       
        $query = "INSERT INTO users (fullname, lastname, email, phone,password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
    
        mysqli_stmt_bind_param($stmt, "sssss", $fullname, $lastname, $email, $phone, $password);
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


        public function getUserByEmail($email) {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = mysqli_prepare($this->db, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
        
            if ($user) {
                return $user; // Return the user details as an associative array
            } else {
                return null; // User not found
            }
        }


        public static function getAllUsers() {
            $connection = db_conn::getConnection();
            $users = [];
        
            $query = "SELECT u.*, r.name AS role 
                      FROM users u
                      LEFT JOIN roles_users ru ON u.id = ru.users_id
                      LEFT JOIN roles r ON ru.roles_id = r.id";
        
            $result = mysqli_query($connection, $query);
        
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $user = new User(
                        $row['fullname'],
                        $row['lastname'],
                        $row['email'],
                        $row['phone'],
                        $row['password']
                    );
                    $user->id = $row['id']; // Set the user ID
                    $user->setRole($row['role']); // Set the role directly
        
                    $users[] = $user;
                }
                mysqli_free_result($result);
            }
        
            return $users;
        }

        public function getUserRole($userId) {
            $query = "SELECT roles_id FROM roles_users WHERE users_id = ?";
            $stmt = mysqli_prepare($this->db, $query);
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        
            if (!$result) {
                // Handle SQL error (example: return null or log the error)
                return null;
            }
        
            $role = mysqli_fetch_assoc($result);
        
            if (!$role) {
                // Handle role not found (example: return null or log the issue)
                return null;
            }
        
            return $role['roles_id']; // Assuming the roles_id is the role identifier
        }
        public static function getUserById($userId) {
            $connection = db_conn::getConnection();
            $user = null;
            
            $query = "SELECT u.*, r.name AS role 
                      FROM users u
                      LEFT JOIN roles_users ru ON u.id = ru.users_id
                      LEFT JOIN roles r ON ru.roles_id = r.id
                      WHERE u.id = ?";
                      
            $stmt = mysqli_prepare($connection, $query);
            
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            
            if ($result && $row = mysqli_fetch_assoc($result)) {
                $user = new User(
                    $row['fullname'],
                    $row['lastname'],
                    $row['email'],
                    $row['phone'],
                    $row['password']
                );
                $user->id = $row['id'];
                $user->setRole($row['role']); // Set the role name
            }
            
            mysqli_stmt_close($stmt);
            return $user;
        }
        

        public function deleteUserById($userId) {
            $connection = db_conn::getConnection();
    
            // Delete the user from the roles_users table
            $deleteRolesUserQuery = "DELETE FROM roles_users WHERE users_id = $userId";
            $stmtRolesUser = $connection->query($deleteRolesUserQuery);
    
            // Delete the user from the users table
            $deleteUserQuery = "DELETE FROM users WHERE id = $userId";
            $stmtUser = $connection->query($deleteUserQuery);
    
            // Check if both delete operations were successful
            if ($stmtRolesUser && $stmtUser) {
                return true; // Deletion successful
            } else {
                return false; // User not found or deletion failed
            }
        }










        public function addUser(User $user) {
        $fullname = $user->getFullName();
        $lastname = $user->getLastName();
        $email = $user->getEmail(); 
        $phone = $user->getPhone();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
       
        $query = "INSERT INTO users (fullname, lastname, email, phone,password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
    
        mysqli_stmt_bind_param($stmt, "sssss", $fullname, $lastname, $email, $phone, $password);
        $success = mysqli_stmt_execute($stmt);
    
        if ($success) {
            // User created successfully
            $userId = mysqli_insert_id($this->db); // Get the ID of the newly inserted user
    
            // Assign 'User' role to the user by default
            $roleId = $user->getrole(); // Assuming 'User' role has ID 2, adjust as per your roles table
    
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



        
        public function updateUser(User $user) {
            $connection = db_conn::getConnection();
        
            // Extract user attributes
            $userId = $user->getId();
            $fullname = $user->getFullname();
            $lastname = $user->getLastname();
            $email = $user->getEmail();
            $phone = $user->getPhone();
            $roleId = $user->getRole();
        
            // Update basic user information (fullname, lastname, email, phone)
            $basicQuery = "UPDATE users SET fullname=?, lastname=?, email=?, phone=? WHERE id=?";
            $basicStmt = mysqli_prepare($connection, $basicQuery);
        
            if (
                $basicStmt &&
                mysqli_stmt_bind_param(
                    $basicStmt,
                    "ssssi",
                    $fullname,
                    $lastname,
                    $email,
                    $phone,
                    $userId
                ) &&
                mysqli_stmt_execute($basicStmt)
            ) {
                mysqli_stmt_close($basicStmt);
            } else {
                return false; // Failed to update basic user information
            }
        
            // Update user role in the intermediary table roles_users
            $roleQuery = "UPDATE roles_users SET roles_id=? WHERE users_id=?";
            $roleStmt = mysqli_prepare($connection, $roleQuery);
        
            if (
                $roleStmt &&
                mysqli_stmt_bind_param(
                    $roleStmt,
                    "ii",
                    $roleId,
                    $userId
                ) &&
                mysqli_stmt_execute($roleStmt)
            ) {
                mysqli_stmt_close($roleStmt);
                return true; // Successfully updated user role
            } else {
                return false; // Failed to update user role
            }
        }


        public function countUsers() {
            $query = "SELECT COUNT(*) as user_count FROM users"; 
            $result = mysqli_query($this->db, $query);
            $data = mysqli_fetch_assoc($result);
    
            return $data['user_count'];
        }
    
        public function countBooks() {
            $query = "SELECT COUNT(*) as book_count FROM book";
            $result = mysqli_query($this->db, $query);
            $data = mysqli_fetch_assoc($result);
    
            return $data['book_count'];
        }

        public function countReservations() {
            $query = "SELECT COUNT(*) as reservation_count FROM reservation";
            $result = mysqli_query($this->db, $query);
            $data = mysqli_fetch_assoc($result);
    
            return $data['reservation_count'];
        }


}




