<?php 

namespace App\Controllers;

require_once __DIR__ ."/../../vendor/autoload.php";

use App\Models\Reservation;
use App\Methods\ReservationDAO;


class ReservationController{

    public function addReservation($reservation) { 
        $bookId = $reservation->getBookId();
        $userId = $reservation->getUserId();
        $reservationDate = $reservation->getReservationDate();
        $returnDate = $reservation->getReturnDate();


        // Additional validation/sanitization can be done here

        $reservationDAO = new ReservationDAO();
        $added = $reservationDAO->addReservation($reservation);
    
        return $added;
    }

    public function getReservationsForUser($userId) {
        $usersReservations = ReservationDAO::getReservationsForUser($userId);
        return $usersReservations;
        
    }
    // public function getReservations_admin() {
    //     $allReservation = ReservationDAO::getAllReservations_admin();
    //     return $allReservation;
    // }
}





if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserveButton'])) {
    // Retrieving form data
    $bookId = $_POST['bookId'];
    $userId = $_POST['userId'];
    $reservationDate = $_POST['reservationDate'];
    $returnDate = $_POST['returnDate'];
    $isReturned = 0;

    // Create a Reservation object
    $reservation = new Reservation($reservationDate, $returnDate, $isReturned,$bookId, $userId);


    $reservationController = new ReservationController();

    $added = $reservationController->addReservation($reservation);

    
    if ($added) {
        header("Location: /Brief-9-library-managment/views/user/profile.php");
        exit();
    } else {
        echo "Failed to add reservation to the database.";
    }
    // // Display the reservation information
    // echo "<h2>Reservation Information</h2>";
    // echo "<p>Book ID: " . $reservation->getBookId() . "</p>";
    // echo "<p>User ID: " . $reservation->getUserId() . "</p>";
    // echo "<p>Reservation Date: " . $reservation->getReservationDate() . "</p>";
    // echo "<p>Return Date: " . $reservation->getReturnDate() . "</p>";

}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['reservation_id'])) {
    $reservationId = $_GET['reservation_id'];

    $reservationDAO = new ReservationDAO();
    $reservationDAO->deleteReservation($reservationId);
    
    // Redirect back to the reservations page after deletion
    header("Location: /Brief-9-library-managment/views/user/profile.php");
    exit();
}