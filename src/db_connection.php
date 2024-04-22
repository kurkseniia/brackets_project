<?php
$servername = "mariadb";
$username = "root";
$password = "root";
$database_name = "brackets"; 

// create connection 
$connection = new mysqli($servername, $username, $password, $database_name);

// checking connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// making request and accept data
function fetchData($connection, $query) {
    $result = $connection->query($query);
    
    if (!$result) {
        die("Error executing query: " . $connection->error);
    }

    // getting data in form of array 
    $data = $result->fetch_all(MYSQLI_ASSOC);

    $result->close();

    return $data;
}
