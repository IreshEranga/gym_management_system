<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['User_ID'], $data['name'], $data['email'], $data['mobile'], $data['address'], $data['emergency_contact_number'])) {
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    $query = "UPDATE user SET name = ?, email = ?, mobile = ?, address = ?, emergency_contact_number = ?, membership_ID = ? WHERE User_ID = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssisi", $data['name'], $data['email'], $data['mobile'], $data['address'], $data['emergency_contact_number'], $data['membership_ID'], $data['User_ID']);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Trainer updated successfully"]);
        } else {
            echo json_encode(["error" => "Failed to update trainer"]);
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
