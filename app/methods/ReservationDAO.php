<?php 

namespace App\Methods;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Reservation;
use App\Database\db_conn;


class ReservationDAO {

    //remember to add a condition to chekc if there is available books first then add the reservation 
    // public function addReservation(Reservation $reservation) {
    //     $reservationDate = $reservation->getReservationDate();
    //     $returnDate = $reservation->getReturnDate();
    //     $bookId = $reservation->getBookId();
    //     $userId = $reservation->getUserId();
    //     $isReturned = 0; // Default value for is_returned
    
    //     try {
    //         $conn = db_conn::getConnection();
    
    //         $sql = "INSERT INTO reservation (reservation_date, return_date, is_returned, book_id, users_id) 
    //                 VALUES (?, ?, ?, ?, ?)";
    
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bind_param('ssiis', $reservationDate, $returnDate, $isReturned, $bookId, $userId);
            
    //         $stmt->execute();
    
    //         return true; 
    //     } catch (\Exception $e) {
    //         return false; 
    //     }
    // }

    public function addReservation(Reservation $reservation) {
        $reservationDate = $reservation->getReservationDate();
        $returnDate = $reservation->getReturnDate();
        $bookId = $reservation->getBookId();
        $userId = $reservation->getUserId();
        $isReturned = 0; // Default value for is_returned
    
        try {
            $conn = db_conn::getConnection();
    
            // Update available copies and insert reservation in a single transaction
            $conn->begin_transaction();
    
            // Check and update available copies
            $updateCopies = "UPDATE book SET availableCopies = availableCopies - 1 WHERE id = ? AND availableCopies > 0";
            $stmtUpdate = $conn->prepare($updateCopies);
            $stmtUpdate->bind_param('i', $bookId);
            $stmtUpdate->execute();
    
            if ($stmtUpdate->affected_rows > 0) {
                // Add the reservation
                $sql = "INSERT INTO reservation (reservation_date, return_date, is_returned, book_id, users_id) 
                        VALUES (?, ?, ?, ?, ?)";
    
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssiis', $reservationDate, $returnDate, $isReturned, $bookId, $userId);
                $stmt->execute();
    
                $conn->commit(); // Commit the transaction
                return true;
            } else {
                $conn->rollback(); // Rollback changes if no available copies
                return false; // No available copies or book not found
            }
        } catch (\Exception $e) {
            return false; // Handle exceptions
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
                        $row['is_returned'],
                        $row['book_title'], 
                        $row['is_returned']
                    );
                    $reservation->id = $row['reservation_id']; 

                    $reservations[] = $reservation;
                }
                $stmt->close();
            }

            return $reservations;
            }
            public function getAllReservationsForAdmin() {
                $connection = db_conn::getConnection();
                $reservations = [];
        
                $query = "SELECT id, reservation_date, return_date, is_returned, book_id, users_id
                          FROM reservation";
        
                $result = $connection->query($query);
        
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $reservation = new Reservation(
                            $row['reservation_date'],
                            $row['return_date'],
                            $row['is_returned'],
                            $row['book_id'],
                            $row['users_id']
                            
                        );
                        $reservation->id = $row['id'];
        
                        $reservations[] = $reservation;
                    }
                    $result->close();
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