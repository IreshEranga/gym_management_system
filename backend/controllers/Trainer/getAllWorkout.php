<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
header('Content-Type: application/json');

// Database connection
$conn = new mysqli("localhost", "root", "", "gym_management_system");

// Check for database connection error
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// SQL Query to fetch workout data
$sql = "SELECT workout_ID, title, description, user_ID FROM workout";
$result = $conn->query($sql);

// Initialize an empty array to hold workouts
$workouts = [];

// Check if the query was successful and if it returned rows
if ($result) {
    if ($result->num_rows > 0) {
        // Fetch all workouts into the array
        while ($row = $result->fetch_assoc()) {
            $workouts[] = $row;
        }
    } else {
        // Return a message if no workouts are found
        $workouts = ["message" => "No workouts available."];
    }
} else {
    // If the query fails, send an error message
    echo json_encode(["error" => "Failed to retrieve workouts: " . $conn->error]);
    exit();
}

// Send the workouts array as JSON response
echo json_encode($workouts);

// Close the database connection
$conn->close();

