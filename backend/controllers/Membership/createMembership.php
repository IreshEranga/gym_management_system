<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['type'], $data['description'], $data['expire_date'])) {
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    $query = "INSERT INTO membership (type, description, expire_date) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        // Binding parameters: type (string), description (string), expire_date (string)
        $stmt->bind_param("sss", $data['type'], $data['description'], $data['expire_date']);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Membership created successfully", "membership_ID" => $stmt->insert_id]);
        } else {
            echo json_encode(["error" => "Failed to create membership"]);
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
