<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['membership_ID'])) {
        echo json_encode(["error" => "Missing membership_ID"]);
        exit;
    }

    $query = "DELETE FROM membership WHERE membership_ID = ?";

    if ($stmt = $conn->prepare($query)) {
        // Binding parameter: membership_ID (integer)
        $stmt->bind_param("i", $data['membership_ID']);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => "Membership deleted successfully"]);
            } else {
                echo json_encode(["error" => "Membership not found"]);
            }
        } else {
            echo json_encode(["error" => "Failed to delete membership"]);
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
