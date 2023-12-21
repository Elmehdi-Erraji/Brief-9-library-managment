<?php 

namespace App\Methods;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Reservation;
use App\Database\db_conn;


class ReservationDAO {
    private $db;

    public function __construct() {
        $this->db = db_conn::getConnection(); // Get the database connection
    }

}