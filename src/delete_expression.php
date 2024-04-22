<?
require_once 'db_connection.php';

// getting data from a POST request
$inputData = json_decode(file_get_contents('php://input'), true);

// check that the data has been sent
if (isset($inputData['expressionID'])) {
    // checking for the ID in the request
    $expressionID = $inputData['expressionID'];
    
    // preparing request to delete a record
    $sqlDelete = "DELETE FROM expressionsHistory WHERE expressionID = $expressionID";

    // making request
    try {
        if (!$connection->query($sqlDelete)) {
            throw new Exception("Error executing query: " . $connection->error);
        }
        // returning a successful deletion result
        echo json_encode("Success");
    } catch (Exception $e) {
        die(json_encode(array("error" => $e->getMessage ())));
    }
} else {
    echo json_encode(array("error" => "No expressionID received"));
}

$sqlReset = "SET @num := 0;
        UPDATE expressionsHistory SET expressionID = @num := (@num + 1);
        ALTER TABLE expressionsHistory AUTO_INCREMENT = 1;";
if (!$connection->multi_query($sqlReset)) {
    die(json_encode(array("error" => "Error executing query: " . $connection->error)));
}
