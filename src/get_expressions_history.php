<?php
require_once 'db_connection.php';

$data = array();

// prepare the SQL query
$query = "SELECT * FROM expressionsHistory ORDER BY expressionID DESC";

// prepare the statement
$stmt = $connection->prepare($query);
$stmt->execute();
$stmt->bind_result($expressionID, $expression, $result);

// fetch data
while ($stmt->fetch()) {
    $data[] = array(
        'expressionID' => $expressionID,
        'expression' => $expression,
        'result' => $result
    );
}

$stmt->close();

echo json_encode($data);
