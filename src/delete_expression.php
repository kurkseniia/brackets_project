<?php
require_once 'db_connection.php';

// getting data from a POST request
$inputData = json_decode(file_get_contents('php://input'), true);

// check that the data has been sent
if (isset($inputData['expressionID'])) {
    // checking for the ID in the request
    $expressionID = $inputData['expressionID'];

    // preparing request to delete record
    $sqlDelete = "DELETE FROM expressionsHistory WHERE expressionID = ?";

    // prepare statement
    $stmt = $connection->prepare($sqlDelete);

    // bind parameter and execute statement
    $stmt->bind_param("i", $expressionID);
    $stmt->execute();

    // check for errors
    if ($stmt->errno) {
        die(json_encode(array("error" => "Error executing query: " . $stmt->error)));
    }

    // close the statement
    $stmt->close();

    // returning a successful deletion result
    echo json_encode("Success");
} else {
    // no expressionID received
    echo json_encode(array("error" => "No expressionID received"));
}


