<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $query = "SELECT equipment_ID, equipment_name, last_service_date, status FROM gym_equipment";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $result = $stmt->get_result();

        $equipment = [];

        while ($row = $result->fetch_assoc()) {
            $equipment[] = $row;
        }

        echo json_encode(["equipment" => $equipment]);

        $stmt->close();
    } else {
        echo json_encode(["error" => "Query execution failed"]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
