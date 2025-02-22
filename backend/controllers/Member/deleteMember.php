<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['User_ID'])) {
        echo json_encode(["error" => "User ID is required"]);
        exit;
    }

    $query = "DELETE FROM user WHERE User_ID = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $data['User_ID']);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Member deleted successfully"]);
        } else {
            echo json_encode(["error" => "Failed to delete member"]);
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
