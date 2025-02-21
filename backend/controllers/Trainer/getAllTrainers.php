<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $query = "SELECT User_ID, name, email, mobile, address, emergency_contact_number FROM user WHERE role_ID = 2";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        $trainers = [];
        
        while ($row = $result->fetch_assoc()) {
            $trainers[] = $row;
        }
        
        if (count($trainers) > 0) {
            echo json_encode($trainers);
        } else {
            echo json_encode(["error" => "No trainers found"]);
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
