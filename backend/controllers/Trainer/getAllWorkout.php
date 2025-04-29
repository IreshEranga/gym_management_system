<?php
header("Content-Type: application/json");
include '../../config/database.php';

$query = "SELECT workout_ID, title, description, user_ID FROM workouts";
$result = $conn->query($query);

$workouts = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $workouts[] = $row;
    }
    echo json_encode($workouts);
} else {
    echo json_encode(["error" => "Failed to fetch workouts"]);
}

$conn->close();
?>
