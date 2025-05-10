<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = "SELECT User_ID, name, email, mobile, address, emergency_contact_number, membership_ID FROM user WHERE role_ID = 3";
    $result = $conn->query($query);

    $trainees = [];

    while ($row = $result->fetch_assoc()) {
        $trainees[] = $row;
    }

    echo json_encode($trainees);

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
