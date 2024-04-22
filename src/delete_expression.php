<?
require_once 'db_connection.php';

// получаем данные из POST-запроса
$inputData = json_decode(file_get_contents('php://input'), true);

// проверяем, что данные были переданы
if (isset($inputData['expressionID'])) {
    // проверяем наличие ID в запросе
    $expressionID = $inputData['expressionID'];
    
    // подготовка запроса для удаления записи
    $sqlDelete = "DELETE FROM expressionsHistory WHERE expressionID = $expressionID";

    // выполнение запроса
    try {
        if (!$connection->query($sqlDelete)) {
            // обработка ошибки выполнения запроса
            throw new Exception("Error executing query: " . $connection->error);
        }
        // возвращаем успешный результат удаления
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
