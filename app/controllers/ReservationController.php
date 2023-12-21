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
}





if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserveButton'])) {
    // Retrieving form data
    $bookId = $_POST['bookId'];
    $userId = $_POST['userId'];
    $reservationDate = $_POST['reservationDate'];
    $returnDate = $_POST['returnDate'];

    // Create a Reservation object
    $reservation = new Reservation($reservationDate, $returnDate, $bookId, $userId);


    $reservationController = new ReservationController();

    $added = $reservationController->addReservation($reservation);

    
    if ($added) {
        header("Location: /success.php");
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