<?php
require_once 'db_connection.php';

$data = array();
$query = "SELECT * FROM expressionsHistory ORDER BY expressionID DESC";

// get data 
$data = fetchData($connection, $query);

echo json_encode($data);
