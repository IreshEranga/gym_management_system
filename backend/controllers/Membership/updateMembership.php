<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['membership_ID'], $data['type'], $data['description'], $data['expire_date'])) {
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    $query = "UPDATE membership SET type = ?, description = ?, expire_date = ? WHERE membership_ID = ?";

    if ($stmt = $conn->prepare($query)) {
        // Corrected binding parameters
        $stmt->bind_param("sssi", $data['type'], $data['description'], $data['expire_date'], $data['membership_ID']);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Membership updated successfully"]);
        } else {
            echo json_encode(["error" => "Failed to update Membership"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Query preparation failed"]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
