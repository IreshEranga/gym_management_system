<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate required fields
    if (!isset($data['id'])) {
        echo json_encode(["error" => "Missing schedule ID"]);
        exit;
    }

    // Get the logged-in trainer's ID from session
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["error" => "Trainer not logged in"]);
        exit;
    }
    $trainer_id = $_SESSION['user_id'];

    // Query to delete the schedule
    $query = "DELETE FROM schedule WHERE id = ? AND trainer_id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ii", $data['id'], $trainer_id);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Schedule deleted successfully"]);
        } else {
            echo json_encode(["error" => "Failed to delete schedule"]);
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