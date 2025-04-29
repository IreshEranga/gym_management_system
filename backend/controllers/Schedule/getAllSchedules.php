<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the logged-in trainer's ID from session
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["error" => "Trainer not logged in"]);
        exit;
    }
    $trainer_id = $_SESSION['user_id'];

    // Query to get all schedules for the trainer
    $query = "SELECT id, date, time, client_name, session_type 
              FROM schedule 
              WHERE trainer_id = ? 
              ORDER BY date, time";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $trainer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $schedules = [];
        while ($row = $result->fetch_assoc()) {
            $schedules[] = $row;
        }

        echo json_encode(["schedules" => $schedules]);
        $stmt->close();
    } else {
        echo json_encode(["error" => "Query preparation failed"]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>