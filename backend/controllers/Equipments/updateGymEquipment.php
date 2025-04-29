<?php
session_start();
include '../../config/database.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "PUT" && isset($data)) {
    $id = $data["equipment_ID"];
    $name = $data["equipment_name"];
    $last_service_date = $data["last_service_date"];
    $status = $data["status"];

    $query = "UPDATE gym_equipment SET equipment_name=?, last_service_date=?, status=? WHERE equipment_ID=?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sssi", $name, $last_service_date, $status, $id);
        if ($stmt->execute()) {
            echo json_encode(["success" => "Equipment updated successfully"]);
        } else {
            echo json_encode(["error" => "Execution failed"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["error" => "Preparation failed"]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
