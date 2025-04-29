<?php
header("Content-Type: application/json");
include '../../config/database.php'; // Adjust path if needed

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['title']) || !isset($data['description'])) {
    echo json_encode(["success" => false, "error" => "Missing required fields."]);
    exit;
}

$title = trim($data['title']);
$description = trim($data['description']);
$user_ID = isset($data['user_ID']) && $data['user_ID'] !== '' ? intval($data['user_ID']) : null;

// $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// if ($conn->connect_error) {
//     echo json_encode(["success" => false, "error" => "Database connection failed."]);
//     exit;
// }

$stmt = $conn->prepare("INSERT INTO workouts (title, description, user_ID) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $title, $description, $user_ID);
$success = $stmt->execute();

if ($success) {
    echo json_encode([
        "success" => true,
        "workout_ID" => $stmt->insert_id
    ]);
} else {
    echo json_encode(["success" => false, "error" => "Insert failed."]);
}

$stmt->close();
$conn->close();
