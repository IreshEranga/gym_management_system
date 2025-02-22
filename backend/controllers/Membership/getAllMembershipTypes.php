<?php
session_start();
include '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $query = "SELECT membership_ID, type, description, expire_date FROM membership";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        $memberships = [];
        
        while ($row = $result->fetch_assoc()) {
            $memberships[] = $row;
        }
        
        if (count($memberships) > 0) {
            echo json_encode($memberships);
        } else {
            echo json_encode(["error" => "No memberships found"]);
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
