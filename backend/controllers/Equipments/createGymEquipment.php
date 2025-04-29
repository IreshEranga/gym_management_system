<?php
session_start();
include '../../config/database.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data)) {
    $name = $data["equipment_name"] ?? null;
    $last_service_date = $data["last_service_date"] ?? null;
    $status = $data["status"] ?? null;

    if ($name && $status) {
        $query = "INSERT INTO gym_equipment (equipment_name, last_service_date, status) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("sss", $name, $last_service_date, $status);
            if ($stmt->execute()) {
                echo json_encode(["success" => "Equipment added successfully"]);
            } else {
                echo json_encode(["error" => "Execution failed"]);
            }
            $stmt->close();
        } else {
            echo json_encode(["error" => "Preparation failed"]);
        }
    } else {
        echo json_encode(["error" => "Missing required fields"]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
