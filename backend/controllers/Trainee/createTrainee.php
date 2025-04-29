<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['name'], $data['email'], $data['mobile'], $data['password'], $data['address'], $data['emergency_contact_number'])) {
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    $hashed_password = password_hash($data['password'], PASSWORD_BCRYPT);
    $membership_ID = isset($data['membership_ID']) ? $data['membership_ID'] : null;

    $query = "INSERT INTO user (name, email, mobile, password, address, emergency_contact_number, role_ID, membership_ID) 
              VALUES (?, ?, ?, ?, ?, ?, 3, ?)"; // 3 = Trainee

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssssi", $data['name'], $data['email'], $data['mobile'], $hashed_password, $data['address'], $data['emergency_contact_number'], $membership_ID);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Trainee created successfully", "User_ID" => $stmt->insert_id]);
        } else {
            echo json_encode(["error" => "Failed to create trainee"]);
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
