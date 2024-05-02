<?php

require_once ('db_connection.php');

function brackets($connection, $string) {
    $openingBrackets = ['(', '[', '{', '<'];
    $closingBrackets = [')', ']', '}', '>'];
    $bracketStorage = [];
    $result = true;// default val

    for ($i = 0; $i < strlen($string); $i++) {
        $char = $string[$i];
         // if char open bracket => add on bracketStorage
        if (in_array($char, $openingBrackets)) {
            array_push($bracketStorage, $char);
            // if char close bracket
        } elseif (in_array($char, $closingBrackets)) {
            $lastOpeningBracket = array_pop($bracketStorage);
            //if bracketStorage already empty or lastOpeningBracket not equal char
            if ($lastOpeningBracket === null || array_search($lastOpeningBracket, $openingBrackets) !== array_search($char, $closingBrackets)) {
                $result = false;
                break;
            }
        }
    }
// if bracketStorage not empty
    if (!empty($bracketStorage)) {
        $result = false;
    }

    return $result;
}

// getting data from POST request
$inputData = json_decode(file_get_contents('php://input'), true);

if (isset($inputData['data'])) {
        $data = trim($inputData['data']);

        if (empty($data)) {
            die(json_encode(array("error" => "Empty data received")));
        }

        $result = brackets($connection, $data);

        // prepare and execute SQL query 
        $sql = "INSERT INTO expressionsHistory (expression, result) VALUES (?, ?)";
        $stmt = $connection->prepare($sql);
        $expression = $connection->real_escape_string($data);
        $resultValue = $result ? 1 : 0;
        $stmt->bind_param("si", $expression, $resultValue);
        $stmt->execute();

        if ($stmt->errno) {
            die(json_encode(array("error" => "Error executing query: " . $stmt->error)));
        }
        $stmt->close();

        // return the validation result as a JSON-encoded string
        if ($result) {
            echo json_encode('верно');
        } else {
            echo json_encode('не верно');
        }
    } else {
        echo json_encode(array("error" => $error_message));
    }

$connection->close();