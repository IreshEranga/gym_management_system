<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']); 

    $query = "SELECT name, email, mobile, address, emergency_contact_number, membership_id FROM user WHERE User_ID = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            echo json_encode($row);
        } else {
            echo json_encode(["error" => "User not found"]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["error" => "Query failed"]);
    }
    
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
