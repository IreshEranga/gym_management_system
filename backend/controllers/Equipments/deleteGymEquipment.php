<?php
session_start();
include '../../config/database.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "DELETE" && isset($data["equipment_ID"])) {
    $id = $data["equipment_ID"];

    $query = "DELETE FROM gym_equipment WHERE equipment_ID=?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(["success" => "Equipment deleted successfully"]);
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
