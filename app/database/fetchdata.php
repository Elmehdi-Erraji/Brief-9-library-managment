<?php

require_once __DIR__ . '/../../vendor/autoload.php';


use App\database\db_conn;
function fetchDataFromDB() {
    $dbConnection = db_conn::getConnection();

   
    $query = "SELECT u.*, r.name AS role 
    FROM users u
    LEFT JOIN roles_users ru ON u.id = ru.users_id
    LEFT JOIN roles r ON ru.roles_id = r.id"; 

    $result = mysqli_query($dbConnection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($dbConnection));
    }

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;//assosciative array
}

// Fetch data
$data = fetchDataFromDB();

// Set response header to JSON
header('Content-Type: application/json');

// Output data as JSON
echo json_encode($data);