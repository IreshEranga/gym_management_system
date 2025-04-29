<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate required fields
    if (!isset($data['date'], $data['time'], $data['client_name'], $data['session_type'])) {
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    // Get the logged-in trainer's ID from session
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["error" => "Trainer not logged in"]);
        exit;
    }
    $trainer_id = $_SESSION['user_id'];

    // Query to insert the new schedule
    $query = "INSERT INTO schedule (trainer_id, date, time, client_name, session_type) 
              VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("issss", $trainer_id, $data['date'], $data['time'], $data['client_name'], $data['session_type']);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Schedule added successfully", "schedule_id" => $stmt->insert_id]);
        } else {
            echo json_encode(["error" => "Failed to add schedule"]);
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