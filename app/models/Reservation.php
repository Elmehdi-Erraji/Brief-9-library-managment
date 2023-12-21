<?php

namespace app\models;
class Reservation {
    private $id;
    private $description;
    private $reservationDate;
    private $returnDate;
    private $isReturned;
    private $bookId;
    private $userId;

    public function __construct($description, $reservationDate, $returnDate, $bookId, $userId) {
        $this->description = $description;
        $this->reservationDate = $reservationDate;
        $this->returnDate = $returnDate;
        $this->isReturned = 0; // 0 represents 'not returned'
        $this->bookId = $bookId;
        $this->userId = $userId;
    }

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getReservationDate() {
        return $this->reservationDate;
    }

    public function setReservationDate($reservationDate) {
        $this->reservationDate = $reservationDate;
    }

    public function getReturnDate() {
        return $this->returnDate;
    }

    public function setReturnDate($returnDate) {
        $this->returnDate = $returnDate;
    }

    public function getIsReturned() {
        return $this->isReturned;
    }

    public function setIsReturned($isReturned) {
        $this->isReturned = $isReturned;
    }

    public function getBookId() {
        return $this->bookId;
    }

    public function setBookId($bookId) {
        $this->bookId = $bookId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }
}

