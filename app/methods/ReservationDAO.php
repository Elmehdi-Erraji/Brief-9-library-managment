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

    public static function getReservationsForUser($userId) {
        $connection = db_conn::getConnection();
        $reservations = [];

        $query = "SELECT r.id AS reservation_id, r.reservation_date, r.return_date, r.is_returned, 
                    b.title AS book_title
              FROM reservation r
              INNER JOIN book b ON r.book_id = b.id
              WHERE r.users_id = ? ";
    
            $stmt = $connection->prepare($query);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $reservation = new Reservation(
                        $row['reservation_date'],
                        $row['return_date'],
                        $row['book_title'], // Get the book title from the query result
                        $row['is_returned']
                    );
                    $reservation->id = $row['reservation_id']; // Set the reservation ID

                    $reservations[] = $reservation;
                }
                $stmt->close();
            }

            return $reservations;
            }

                        
            public static function deleteReservation($reservationId) {
                $connection = db_conn::getConnection();

                $query = "DELETE FROM reservation WHERE id = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param('i', $reservationId);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    // Deletion successful
                    return true;
                } else {
                    // Deletion failed
                    return false;
                
                 }
            }

}