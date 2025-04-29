<?php
session_start();
include '../../config/database.php';

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['User_ID'], $data['name'], $data['email'], $data['mobile'], $data['address'], $data['emergency_contact_number'], $data['membership_ID'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    $query = "UPDATE user SET name = ?, email = ?, mobile = ?, address = ?, emergency_contact_number = ?, membership_ID = ? WHERE User_ID = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssisi", $data['name'], $data['email'], $data['mobile'], $data['address'], $data['emergency_contact_number'], $data['membership_ID'], $data['User_ID']);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["success" => "Member updated successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to update member"]);
        }

        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Query preparation failed"]);
    }

    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(["error" => "Invalid request method"]);
}
?>
