<?php 

namespace App\Methods;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Reservation;
use App\Database\db_conn;


class ReservationDAO {

    //remember to add a condition to chekc if there is available books first then add the reservation 
    public function addReservation(Reservation $reservation) {
        $reservationDate = $reservation->getReservationDate();
        $returnDate = $reservation->getReturnDate();
        $bookId = $reservation->getBookId();
        $userId = $reservation->getUserId();
        $isReturned = 0; // Default value for is_returned
    
        try {
            $conn = db_conn::getConnection();
    
            $sql = "INSERT INTO reservation (reservation_date, return_date, is_returned, book_id, users_id) 
                    VALUES (?, ?, ?, ?, ?)";
    
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssiis', $reservationDate, $returnDate, $isReturned, $bookId, $userId);
            
            $stmt->execute();
    
            return true; 
        } catch (\Exception $e) {
            return false; 
        }
    }

    public function getNumberOfReservationsForUser($userId) {
        try {
            $conn = db_conn::getConnection(); // Assuming this establishes a database connection

            // Prepare SQL query to count reservations for the given user ID
            $sql = "SELECT COUNT(*) AS reservation_count FROM reservation WHERE users_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                return $row['reservation_count'];
            } else {
                return 0; // No reservations found for this user
            }
        } catch (\Exception $e) {
            // Handle exception or log error
            return 0; // Return 0 in case of an error
        }
    }

}