<?php
namespace App\database;
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

class db_conn {
    private static $connection;

    private function __construct()
    {
        $dbHost = $_ENV['DB_HOST'];
        $dbUser = $_ENV['DB_USER'];
        $dbPassword = $_ENV['DB_PASSWORD'];
        $dbName = $_ENV['DB_NAME'];

        self::$connection = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
        if (!self::$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public static function getConnection() {
        if (!self::$connection) {
            new self();
        }
        return self::$connection;
    }
}

// Usage without instantiating the class
$connection = db_conn::getConnection();

if (!$connection) {
    echo "Db is connected";
}
