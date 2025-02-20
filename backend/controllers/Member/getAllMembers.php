<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $query = "SELECT User_ID, name, email, mobile, address, emergency_contact_number, membership_id FROM user WHERE role_ID = 3";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        $members = [];
        
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
        
        if (count($members) > 0) {
            echo json_encode($members);
        } else {
            echo json_encode(["error" => "No members found"]);
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
