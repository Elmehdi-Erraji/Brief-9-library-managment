<?php 

namespace app\models;

class User {

    public $id;
    public $fullname;
    public $lastname;
    public $email;
    public $phone;
    public $password;
    public $budget;
    public $table_name = "users";


    public function __construct($fullname,$lastname,$email,$phone,$password,$budget)
    {
        $this->fullname = $fullname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->budget = $budget;
    }

      

      public function getId() {
        return $this->id;
    }


    
    public function getFullname() {
        return $this->fullname;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    
    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    
    public function getBudget() {
        return $this->budget;
    }

    public function setBudget($budget) {
        $this->budget = $budget;
    }
}