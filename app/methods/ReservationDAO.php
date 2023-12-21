<?php 

namespace App\Methods;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Reservation;
use App\Database\db_conn;


class ReservationDAO {
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
    
            return true; // Successfully added reservation
        } catch (\Exception $e) {
            // Handle exception or log error
            return false; // Failed to add reservation
        }
    }

}