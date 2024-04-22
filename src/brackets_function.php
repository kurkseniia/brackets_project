<?php

// Если это предварительный запрос OPTIONS, просто отправляем ответ с кодом 200 и выходим
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Отправляем заголовки до вывода содержимого страницы
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once 'db_connection.php';

function brackets($connection, $string) {

    $openingBrackets = ['(', '[', '{', '<'];
    $closingBrackets = [')', ']', '}', '>'];

    $bracketStorage = [];

    $result = true; // default val

    for ($i = 0; $i < strlen($string); $i++) {
        $char = $string[$i];

         // if char open bracket => add on bracketStorage
        if (in_array($char, $openingBrackets)) {
            array_push($bracketStorage, $char);
        } 
        // if char close bracket
        elseif (in_array($char, $closingBrackets)) {

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

    // SQL-query
    $expression = $connection->real_escape_string($string);
    $sql = "INSERT INTO expressionsHistory (expression, result) VALUES ('$expression', " . ($result ? 1 : 0) . ")";

    try {
        if (!$connection->query($sql)) {

            throw new Exception("Error executing query: " . $connection->error);
        }
    } catch (Exception $e) {
        die(json_encode(array("error" => $e->getMessage())));
    }

    return $result;
}


// Getting data from POST request
$inputData = json_decode(file_get_contents('php://input'), true);

// Check that the data has been transmitted
if (isset($inputData['data'])) {
   // Checking the availability of data in the request
    $data = trim($inputData['data']);

    if (empty($data)) {
        die(json_encode(array("error" => "Empty data received")));
    }

    // Call brackets function
    $result = brackets($connection, $data);

    // return result in JSON 
    echo json_encode($result ? 'верно' : 'не верно');
} else {
    echo json_encode(array("error" => "No data received"));
}


